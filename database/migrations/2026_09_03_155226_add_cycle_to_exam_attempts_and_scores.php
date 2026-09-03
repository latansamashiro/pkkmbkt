<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
         * Migration sebelumnya sudah sempat berhasil menambahkan
         * kolom cycle sebelum gagal di bagian unique index.
         *
         * Jadi kita cek dulu agar tidak duplicate column.
         */

        if (!Schema::hasColumn('exam_attempts', 'cycle')) {
            Schema::table('exam_attempts', function (Blueprint $table) {
                $table->unsignedInteger('cycle')
                    ->default(1)
                    ->after('attempts');
            });
        }

        if (!Schema::hasColumn('exam_attempt_scores', 'cycle')) {
            Schema::table('exam_attempt_scores', function (Blueprint $table) {
                $table->unsignedInteger('cycle')
                    ->default(1)
                    ->after('attempt_number');
            });
        }

        /*
         * Buat index exam_id terpisah terlebih dahulu.
         *
         * Foreign key:
         * exam_id -> exams.id
         *
         * membutuhkan index yang diawali exam_id.
         */
        Schema::table('exam_attempt_scores', function (Blueprint $table) {
            $table->index(
                'exam_id',
                'exam_attempt_scores_exam_id_index'
            );
        });

        /*
         * Sekarang unique lama aman untuk dihapus karena
         * foreign key exam_id sudah memiliki index sendiri.
         */
        Schema::table('exam_attempt_scores', function (Blueprint $table) {
            $table->dropUnique(
                'exam_attempt_scores_exam_id_student_id_attempt_number_unique'
            );

            $table->unique(
                [
                    'exam_id',
                    'student_id',
                    'cycle',
                    'attempt_number',
                ],
                'exam_attempt_scores_cycle_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('exam_attempt_scores', function (Blueprint $table) {
            $table->dropUnique(
                'exam_attempt_scores_cycle_unique'
            );

            $table->unique(
                [
                    'exam_id',
                    'student_id',
                    'attempt_number',
                ],
                'exam_attempt_scores_exam_id_student_id_attempt_number_unique'
            );

            $table->dropIndex(
                'exam_attempt_scores_exam_id_index'
            );

            $table->dropColumn('cycle');
        });

        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->dropColumn('cycle');
        });
    }
};