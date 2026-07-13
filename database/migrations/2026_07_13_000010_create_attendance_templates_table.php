<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_templates', function (Blueprint $table) {
            $table->id();
            $table->string('session_name');
            $table->string('day_name');
            $table->date('attendance_date');
            $table->time('time_begin');
            $table->time('time_end');
            $table->boolean('open_flag')->default(false);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_templates');
    }
};
