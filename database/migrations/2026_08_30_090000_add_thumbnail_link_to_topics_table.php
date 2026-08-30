<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Thumbnail otomatis cuma bisa diambil dari YouTube & Google Drive (keduanya
 * punya endpoint gambar publik yang bisa langsung dipasang di <img>). Buat
 * link dari sumber lain (Vimeo, penyimpanan lain, dst), Panitia/Admin bisa
 * isi URL gambar manual di sini -- kalau kosong, tetap fallback ke logika
 * otomatis YouTube/GDrive seperti biasa, baru gradasi warna polos.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('thumbnail_link')->nullable()->after('file_link');
        });
    }

    public function down(): void
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('thumbnail_link');
        });
    }
};
