<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role_name');
            $table->string('phone_no')->nullable();
            $table->string('faculty_name')->nullable();
            $table->string('program_study_name')->nullable();
            $table->string('certificate_link')->nullable();
            $table->string('profile_picture')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('created_by_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['created_by_id']);
            $table->dropForeign(['updated_by_id']);
        });
        Schema::dropIfExists('users');
    }
};
