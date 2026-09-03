<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * "Riwayat Import" (daftar password hasil Import Excel/CSV, biar bisa
 * di-export ulang kapan saja) sebelumnya cuma disimpan di localStorage
 * browser -- artinya cuma kebaca di browser & akun yang sama persis yang
 * ngerjain importnya. Dipindah ke sini biar kebaca semua akun Admin/Panitia,
 * bukan cuma yang ngimport.
 *
 * PERHATIAN: kolom `password` di sini sengaja plaintext (bukan hash), karena
 * fitur ini memang untuk mengambil-lagi password yang sudah digenerate biar
 * bisa dibagikan ke mahasiswa/mentor/advisor -- sama seperti hash yang
 * ditampilkan sesaat setelah generate. Cuma admin/panitia yang bisa akses
 * halaman ini (sudah dijaga middleware role).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('import_histories', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->string('nama');
            $table->string('email');
            $table->string('password');
            $table->string('kelompok')->nullable();
            $table->string('prodi')->nullable();
            $table->string('advisor_type')->nullable();
            $table->foreignId('imported_by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            // satu baris per (role, email) -- re-import email yang sama nimpa baris lama
            $table->unique(['role_name', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_histories');
    }
};
