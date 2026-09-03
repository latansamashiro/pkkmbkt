<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Sebagian materi (E-Book) linknya cuma bisa dilihat, gak bisa diunduh
 * langsung (mis. link Google Slides / Canva view-only). Kolom ini buat link
 * unduhan terpisah yang opsional -- kalau kosong, tombol Unduh fallback ke
 * logika lama (cek file_link: Google Drive / .pdf langsung), atau
 * disembunyikan kalau memang gak ada cara pasti buat unduh.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('download_link')->nullable()->after('thumbnail_link');
        });
    }

    public function down(): void
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('download_link');
        });
    }
};
