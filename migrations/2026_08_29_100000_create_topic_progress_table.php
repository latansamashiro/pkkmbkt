<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Nyimpen progres tonton video materi (Topic kategori "video") per mahasiswa,
 * dalam persen (0-100). Diisi dari YouTube IFrame Player API di halaman
 * Materi -- sebelumnya progress selalu 0 hardcode karena belum ada tabel ini.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('topic_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('topic_id')->constrained('topics')->cascadeOnDelete();
            $table->unsignedTinyInteger('percent')->default(0);
            $table->timestamps();

            $table->unique(['student_id', 'topic_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topic_progress');
    }
};
