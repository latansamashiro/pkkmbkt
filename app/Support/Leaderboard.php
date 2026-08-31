<?php

namespace App\Support;

/**
 * Perhitungan ranking Leaderboard -- dipakai bareng oleh Mentor & Student
 * controller supaya rumusnya cuma ada di SATU tempat (gak dobel/berisiko beda).
 *
 * Skema poin (total maksimal 1000 kalau absensi & evaluasi 100% lengkap):
 * - Keaktifan/Pelanggaran : net dari activities.activity_value (gak dibatasi, bisa nambah/ngurang bebas)
 * - Absensi   (bobot 600) : (jumlah sesi hadir / total sesi) x 600 -- "1 sesi" = 1 baris AttendanceTemplate
 * - Evaluasi  (bobot 400) : jumlah per-paket dari (skor RATA-RATA semua percobaan / 100) x (400 / jumlah paket)
 *   -> skor per-paket itu sendiri rata-rata dari semua percobaan yang sudah
 *      diselesaikan mahasiswa (maks 3x, lihat App\Support\ExamScoring), dan
 *      proporsional/nyesuaiin diri kalau jumlah paket evaluasi berubah.
 */
class Leaderboard
{
    public static function hitungRanking()
    {
        // Di-cache 30 detik -- halaman Leaderboard ini kemungkinan besar
        // dibuka BARENGAN oleh banyak mahasiswa sekaligus (semua orang mau
        // liat ranking-nya), dan perhitungannya lumayan berat (query +
        // looping semua mahasiswa x semua paket evaluasi). Tanpa cache,
        // SETIAP request bakal ngitung ulang dari nol -- 30 detik itu cukup
        // singkat buat tetap kerasa "real-time", tapi udah jauh ngurangin
        // beban ke database kalau banyak yang buka bersamaan.
        //
        // try-catch di sini PENTING: driver cache-nya "database", dan kalau
        // BANYAK request bentrok pas detik cache-nya baru kadaluarsa (semua
        // coba hitung ulang & nulis cache bersamaan), bisa kena race
        // condition (duplicate key) yang bikin exception. Daripada seluruh
        // halaman Leaderboard error/kosong gara-gara itu, fallback-nya
        // langsung hitung tanpa cache -- tetap tampil benar buat mahasiswa
        // itu, cuma kehilangan sedikit keuntungan performa cache di momen itu.
        try {
            $hasil = \Illuminate\Support\Facades\Cache::remember('leaderboard_ranking', 30, function () {
                return self::hitungRankingTanpaCache();
            });

            // Kalau isi cache-nya ternyata korup/gagal ke-unserialize dengan
            // benar (mis. baris cache di database kepotong/rusak), Laravel
            // gak nge-throw exception -- dia cuma balikin apapun hasil
            // unserialize-nya apa adanya (bisa jadi false/null/dst), bukan
            // Collection/array seperti yang diharapkan. Kalau sampai lolos
            // ke halaman, tampilannya JS error total (bukan cuma kosong).
            // Makanya validasi tipe di sini, bukan cuma pasrah ke cache.
            if (!is_iterable($hasil)) {
                \Illuminate\Support\Facades\Cache::forget('leaderboard_ranking');
                return self::hitungRankingTanpaCache();
            }

            return $hasil;
        } catch (\Throwable $e) {
            report($e);
            return self::hitungRankingTanpaCache();
        }
    }

    protected static function hitungRankingTanpaCache()
    {
        $totalSesi = \App\Models\AttendanceTemplate::count();
        $poinPerSesi = $totalSesi > 0 ? 600 / $totalSesi : 0;

        $exams = \App\Models\Exam::with('details')->get();
        $totalPaketEvaluasi = $exams->count();
        $poinPerPaketEvaluasi = $totalPaketEvaluasi > 0 ? 400 / $totalPaketEvaluasi : 0;

        // Query sekali buat semua mahasiswa (bukan query berulang per-mahasiswa).
        // Sumber skor evaluasi sekarang dari exam_attempt_scores (RATA-RATA
        // semua percobaan), bukan lagi ngitung ulang dari jawaban mentah
        // student_exams (yang cuma nyimpen percobaan TERAKHIR).
        $semuaSkorAttempt = \App\Support\ExamScoring::semuaSkorAttempt();
        $sesiHadirPerMhs = \App\Models\AttendanceDetail::where('status_presence', 'hadir')
            ->selectRaw('student_id, COUNT(*) as jumlah')
            ->groupBy('student_id')
            ->pluck('jumlah', 'student_id');
        $poinAktivitasPerMhs = \App\Models\Activity::selectRaw('student_id, SUM(activity_value) as total')
            ->groupBy('student_id')
            ->pluck('total', 'student_id');

        return \App\Models\User::where('role_name', 'STUDENT')
            ->get(['id', 'name', 'gender', 'profile_picture', 'npm', 'program_study_name'])
            ->map(function ($u) use ($poinPerSesi, $poinPerPaketEvaluasi, $exams, $semuaSkorAttempt, $sesiHadirPerMhs, $poinAktivitasPerMhs) {
                $poinAktivitas = (int) ($poinAktivitasPerMhs[$u->id] ?? 0);

                $sesiHadir = (int) ($sesiHadirPerMhs[$u->id] ?? 0);
                $poinAbsensi = $sesiHadir * $poinPerSesi;

                $poinEvaluasi = 0;
                foreach ($exams as $exam) {
                    $skorList = $semuaSkorAttempt->get($u->id . '-' . $exam->id);
                    if (!\App\Support\ExamScoring::sudahDikerjakan($skorList)) {
                        continue; // paket ini belum pernah dikerjakan mahasiswa ini -> 0 poin dari paket ini
                    }
                    $skorRataRata = \App\Support\ExamScoring::rataRata($skorList);
                    $poinEvaluasi += $poinPerPaketEvaluasi * ($skorRataRata / 100);
                }

                $skor = $poinAktivitas + round($poinAbsensi) + round($poinEvaluasi);

                // Data gender formatnya beda-beda tergantung cara input akunnya:
                // form manual admin pakai 'L'/'P', tapi hasil import Excel pakai
                // 'laki-laki'/'perempuan' -- disamakan dulu di sini.
                $genderMentah = strtolower((string) $u->gender);
                $gender = in_array($genderMentah, ['p', 'perempuan'], true) ? 'P' : 'L';

                return [
                    'id' => $u->id,
                    'nama' => $u->name,
                    'skor' => (int) $skor,
                    'gender' => $gender,
                    'foto' => $u->profile_picture ? asset('storage/' . $u->profile_picture) : null,
                    'npm' => $u->npm,
                    'prodi' => $u->program_study_name,
                ];
            })
            ->sortByDesc('skor')
            ->values();
    }
}
