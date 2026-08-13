<?php

namespace App\Support;

/**
 * Perhitungan skor evaluasi (kuis) 1 mahasiswa buat 1 paket Exam.
 *
 * Sebelumnya logic "cocokin jawaban mahasiswa (StudentExam) sama kunci
 * jawaban (ExamDetail), hitung berapa yang benar, ubah jadi skor 0-100"
 * ini ke-copy-paste di 4 tempat beda (StudentController, Admin\MonitoringController,
 * MentorController, App\Support\Leaderboard) -- sekarang dipusatkan di sini
 * biar kalau ada perbaikan/perubahan aturan, cukup diubah 1 kali di 1 tempat.
 */
class ExamScoring
{
    /**
     * Jumlah jawaban benar mahasiswa buat 1 paket evaluasi.
     *
     * @param  \App\Models\Exam  $exam  Harus sudah eager-load relasi 'details'.
     * @param  \Illuminate\Support\Collection|null  $rows  Baris StudentExam milik mahasiswa itu, khusus untuk $exam ini.
     */
    public static function hitungBenar($exam, $rows): int
    {
        if (!$rows || $rows->isEmpty()) {
            return 0;
        }

        $benar = 0;
        foreach ($rows as $r) {
            $detail = $exam->details->firstWhere('id', $r->exam_detail_id);
            if ($detail && $r->value && strtolower((string) $r->value) === strtolower((string) $detail->key)) {
                $benar++;
            }
        }

        return $benar;
    }

    /**
     * Skor (0-100) mahasiswa buat 1 paket evaluasi. 0 kalau belum dikerjakan
     * sama sekali atau paket itu belum ada soalnya.
     */
    public static function hitungSkor($exam, $rows): int
    {
        $total = $exam->details->count();
        if ($total === 0) {
            return 0;
        }

        $benar = self::hitungBenar($exam, $rows);

        return (int) round($benar / $total * 100);
    }

    /**
     * Sudah dikerjakan mahasiswa itu apa belum (ada minimal 1 baris StudentExam
     * buat paket ini).
     */
    public static function sudahDikerjakan($rows): bool
    {
        return $rows !== null && $rows->isNotEmpty();
    }
}
