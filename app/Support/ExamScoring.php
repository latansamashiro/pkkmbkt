<?php

namespace App\Support;

/**
 * Perhitungan skor evaluasi (kuis) mahasiswa.
 *
 * Sejak fitur "rata-rata semua percobaan" ditambahkan, skor yang dipakai di
 * Leaderboard/Monitoring/Laporan BUKAN skor 1 percobaan aja -- itu RATA-RATA
 * dari SEMUA percobaan (attempt) yang sudah diselesaikan mahasiswa untuk
 * paket evaluasi pada SIKLUS AKTIF (maksimal 3x per siklus). Jika siklus
 * gagal, siklus baru dimulai dan skor siklus lama tidak ikut dirata-ratakan.
 *
 * Sumber datanya tabel `exam_attempt_scores` (1 baris = 1 percobaan yang
 * SUDAH selesai & submit, skornya gak pernah ketimpa) -- BUKAN `student_exams`
 * (itu jawaban mentah per-soal punya percobaan TERAKHIR, ke-overwrite tiap
 * submit, bukan sumber yang tepat buat rata-rata beberapa percobaan).
 */
class ExamScoring
{
    /**
     * Skor rata-rata dari kumpulan skor tiap percobaan.
     *
     * @param  \Illuminate\Support\Collection|array|null  $skorList  Daftar skor (int) tiap percobaan yang sudah diselesaikan.
     * @return int|null  Null kalau belum ada percobaan sama sekali.
     */
    public static function rataRata($skorList): ?int
    {
        if (!$skorList) {
            return null;
        }
        $skorList = collect($skorList);
        if ($skorList->isEmpty()) {
            return null;
        }

        return (int) round($skorList->avg());
    }

    /**
     * Sudah pernah menyelesaikan minimal 1 percobaan apa belum.
     */
    public static function sudahDikerjakan($skorList): bool
    {
        return $skorList !== null && collect($skorList)->isNotEmpty();
    }

    /**
     * Ambil SEMUA skor attempt (buat SEMUA mahasiswa & paket evaluasi
     * sekaligus) dalam 1 query -- dipakai di halaman yang butuh data banyak
     * mahasiswa sekaligus (Leaderboard, Monitoring) biar gak query berulang
     * per-mahasiswa (N+1).
     *
     * @return \Illuminate\Support\Collection  keyBy "studentId-examId" -> Collection skor (int[])
     */
    public static function semuaSkorAttempt(): \Illuminate\Support\Collection
    {
        // Hanya skor dari siklus AKTIF yang dihitung. Setelah 3 percobaan
        // gagal, siklus lama otomatis tidak ikut ke leaderboard/monitoring.
        return \App\Models\ExamAttemptScore::query()
            ->join('exam_attempts', function ($join) {
                $join->on('exam_attempt_scores.exam_id', '=', 'exam_attempts.exam_id')
                    ->on('exam_attempt_scores.student_id', '=', 'exam_attempts.student_id')
                    ->on('exam_attempt_scores.cycle', '=', 'exam_attempts.cycle');
            })
            ->select('exam_attempt_scores.student_id', 'exam_attempt_scores.exam_id', 'exam_attempt_scores.skor')
            ->get()
            ->groupBy(fn ($r) => $r->student_id . '-' . $r->exam_id)
            ->map(fn ($grup) => $grup->pluck('skor'));
    }
}
