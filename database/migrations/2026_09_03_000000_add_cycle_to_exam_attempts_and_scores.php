<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->unsignedInteger('cycle')->default(1)->after('attempts');
            $table->index(['exam_id', 'student_id', 'cycle']);
        });

        Schema::table('exam_attempt_scores', function (Blueprint $table) {
            $table->unsignedInteger('cycle')->default(1)->after('attempt_number');
        });

        // attempt_number hanya unik di dalam satu siklus.
        Schema::table('exam_attempt_scores', function (Blueprint $table) {
            $table->dropUnique(['exam_id', 'student_id', 'attempt_number']);
            $table->unique(['exam_id', 'student_id', 'cycle', 'attempt_number']);
            $table->index(['exam_id', 'student_id', 'cycle']);
        });
    }

    public function down(): void
    {
        Schema::table('exam_attempt_scores', function (Blueprint $table) {
            $table->dropUnique(['exam_id', 'student_id', 'cycle', 'attempt_number']);
            $table->dropIndex(['exam_id', 'student_id', 'cycle']);
            $table->dropColumn('cycle');
            $table->unique(['exam_id', 'student_id', 'attempt_number']);
        });

        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->dropIndex(['exam_id', 'student_id', 'cycle']);
            $table->dropColumn('cycle');
        });
    }
};
