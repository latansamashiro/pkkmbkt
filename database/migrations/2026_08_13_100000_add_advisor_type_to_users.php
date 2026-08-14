<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Cuma relevan buat akun dengan role_name = 'ADVISOR'. Nilainya
            // 'pembimbing' atau 'koordinator' -- default 'pembimbing' biar akun
            // advisor yang udah ada sebelum fitur ini tetap jalan normal.
            $table->string('advisor_type')->nullable()->default('pembimbing')->after('role_name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('advisor_type');
        });
    }
};
