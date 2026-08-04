<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kode kelompok yang diinput (misal lewat import CSV) tapi kelompoknya
            // belum ada di tabel groups. Begitu ada kelompok baru dengan kode ini
            // dibuat, mahasiswa ini otomatis ditarik masuk (lihat Group::booted()).
            $table->string('pending_group_code')->nullable()->after('npm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pending_group_code');
        });
    }
};
