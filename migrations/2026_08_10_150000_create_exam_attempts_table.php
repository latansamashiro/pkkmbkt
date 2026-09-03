<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Nyimpen berapa kali seorang mahasiswa sudah KIRIM HASIL (submit) untuk
 * 1 paket evaluasi tertentu -- dipakai buat batasin maksimal 3x percobaan.
 * Sengaja dipisah dari student_exams (yang nyimpen jawaban per-soal dan
 * ke-overwrite tiap submit) karena butuh HITUNGAN yang gak ketimpa.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestamps();

            $table->unique(['exam_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};
