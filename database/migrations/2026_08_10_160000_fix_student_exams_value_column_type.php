<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kolom 'value' di student_exams dulunya dibuat bertipe INTEGER, padahal
 * yang disimpan itu HURUF pilihan jawaban ('a', 'b', 'c', 'd') -- bikin
 * setiap submit kuis gagal (SQLSTATE 1366: Incorrect integer value).
 * Drop + bikin ulang sebagai VARCHAR (bukan pakai ->change(), supaya
 * gak butuh package doctrine/dbal).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_exams', function (Blueprint $table) {
            $table->dropColumn('value');
        });
        Schema::table('student_exams', function (Blueprint $table) {
            $table->string('value', 10)->nullable()->after('question');
        });
    }

    public function down(): void
    {
        Schema::table('student_exams', function (Blueprint $table) {
            $table->dropColumn('value');
        });
        Schema::table('student_exams', function (Blueprint $table) {
            $table->integer('value')->nullable()->after('question');
        });
    }
};
