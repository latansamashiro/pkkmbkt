<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Nyimpen SKOR HASIL tiap percobaan (attempt) evaluasi mahasiswa -- beda
 * dari student_exams (jawaban mentah per-soal, ke-overwrite tiap submit)
 * dan exam_attempts (cuma HITUNGAN berapa kali udah nyoba). Tabel ini yang
 * jadi sumber buat ngitung RATA-RATA skor dari semua percobaan (maks 3x),
 * yang baru itu dikirim ke Leaderboard & Monitoring/Laporan.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempt_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('attempt_number');
            $table->unsignedTinyInteger('skor'); // 0-100, hasil 1 percobaan itu aja
            $table->timestamps();

            $table->unique(['exam_id', 'student_id', 'attempt_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempt_scores');
    }
};
