<?php

namespace App\Support;

/**
 * Perhitungan ranking Leaderboard -- dipakai bareng oleh Mentor & Student
 * controller supaya rumusnya cuma ada di SATU tempat (gak dobel/berisiko beda).
 *
 * Skema poin (total maksimal 1000 kalau absensi & evaluasi 100% lengkap):
 * - Keaktifan/Pelanggaran : net dari activities.activity_value (gak dibatasi, bisa nambah/ngurang bebas)
 * - Absensi   (bobot 600) : (jumlah sesi hadir / total sesi) x 600 -- "1 sesi" = 1 baris AttendanceTemplate
 * - Evaluasi  (bobot 400) : jumlah per-paket dari (skor paket / 100) x (400 / jumlah paket)
 *   -> proporsional sesuai skor, dan otomatis nyesuaiin diri kalau jumlah
 *      paket evaluasi berubah (400 dibagi rata, bukan per-paket fixed).
 */
class Leaderboard
{
    public static function hitungRanking()
    {
        $totalSesi = \App\Models\AttendanceTemplate::count();
        $poinPerSesi = $totalSesi > 0 ? 600 / $totalSesi : 0;

        $exams = \App\Models\Exam::with('details')->get();
        $totalPaketEvaluasi = $exams->count();
        $poinPerPaketEvaluasi = $totalPaketEvaluasi > 0 ? 400 / $totalPaketEvaluasi : 0;

        // Query sekali buat semua mahasiswa (bukan query berulang per-mahasiswa)
        $semuaStudentExam = \App\Models\StudentExam::all()->groupBy(fn ($r) => $r->student_id . '-' . $r->exam_id);
        $sesiHadirPerMhs = \App\Models\AttendanceDetail::where('status_presence', 'hadir')
            ->selectRaw('student_id, COUNT(*) as jumlah')
            ->groupBy('student_id')
            ->pluck('jumlah', 'student_id');
        $poinAktivitasPerMhs = \App\Models\Activity::selectRaw('student_id, SUM(activity_value) as total')
            ->groupBy('student_id')
            ->pluck('total', 'student_id');

        return \App\Models\User::where('role_name', 'STUDENT')
            ->get(['id', 'name', 'gender', 'profile_picture', 'npm', 'program_study_name'])
            ->map(function ($u) use ($poinPerSesi, $poinPerPaketEvaluasi, $exams, $semuaStudentExam, $sesiHadirPerMhs, $poinAktivitasPerMhs) {
                $poinAktivitas = (int) ($poinAktivitasPerMhs[$u->id] ?? 0);

                $sesiHadir = (int) ($sesiHadirPerMhs[$u->id] ?? 0);
                $poinAbsensi = $sesiHadir * $poinPerSesi;

                $poinEvaluasi = 0;
                foreach ($exams as $exam) {
                    $totalSoal = $exam->details->count();
                    if ($totalSoal === 0) {
                        continue;
                    }
                    $rows = $semuaStudentExam->get($u->id . '-' . $exam->id);
                    if (!$rows || $rows->isEmpty()) {
                        continue; // paket ini belum dikerjakan mahasiswa ini -> 0 poin dari paket ini
                    }
                    $benar = 0;
                    foreach ($rows as $r) {
                        $detail = $exam->details->firstWhere('id', $r->exam_detail_id);
                        if ($detail && $r->value && strtolower((string) $r->value) === strtolower((string) $detail->key)) {
                            $benar++;
                        }
                    }
                    $poinEvaluasi += $poinPerPaketEvaluasi * ($benar / $totalSoal);
                }

                $skor = $poinAktivitas + round($poinAbsensi) + round($poinEvaluasi);

                // Data gender formatnya beda-beda tergantung cara input akunnya:
                // form manual admin pakai 'L'/'P', tapi hasil import Excel pakai
                // 'laki-laki'/'perempuan' -- disamakan dulu di sini.
                $genderMentah = strtolower((string) $u->gender);
                $gender = in_array($genderMentah, ['p', 'perempuan'], true) ? 'P' : 'L';

                return [
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
