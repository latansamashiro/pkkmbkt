<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            // 'advisor_id' yang lama dipakai buat Pembimbing. Koordinator itu
            // akun Advisor lain (advisor_type='koordinator'), disimpan terpisah
            // biar 1 kelompok bisa punya Pembimbing DAN Koordinator sekaligus.
            $table->foreignId('koordinator_id')->nullable()->after('advisor_id')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropConstrainedForeignId('koordinator_id');
        });
    }
};
