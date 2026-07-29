<?php

// ==========================================================
// TAMBAHKAN BLOK INI KE routes/web.php (di project Laravel-mu)
// Taruh di ATAS blok Route::middleware(['auth'])->group(...) yang sudah ada,
// karena halaman publik ini TIDAK butuh login.
// ==========================================================

use App\Http\Controllers\PublicController;
use App\Http\Controllers\MahasiswaController;

Route::name('public.')->group(function () {
    Route::get('/', [PublicController::class, 'splash'])->name('splash');
    Route::get('/home', [PublicController::class, 'home'])->name('home');
    Route::get('/informasi', [PublicController::class, 'informasi'])->name('informasi');
    Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
    Route::get('/jadwal', [PublicController::class, 'jadwal'])->name('jadwal');
});

// modul.html sebenarnya halaman mahasiswa (butuh login), tapi baru 1 halaman
// ini saja yang sudah jadi dari grup mahasiswa, jadi untuk sementara belum
// dikunci middleware 'auth'. Nanti kalau grup mahasiswa sudah lengkap,
// pindahkan baris ini ke dalam group 'auth' bareng route mahasiswa lain.
Route::name('mahasiswa.')->group(function () {
    Route::get('/mahasiswa/modul', [MahasiswaController::class, 'modul'])->name('modul');
});

// --------------------------------------------------------------
// CATATAN:
// - Route::get('/', function () { return view('welcome'); }); yang lama
//   di web.php kamu SEBAIKNYA DIHAPUS/diganti, supaya '/' menampilkan splash
//   screen index.html (public.splash) ini, bukan halaman "welcome" bawaan
//   Laravel.
// - Nav dropdown "Tentang" (Sejarah / Visi & Misi) masih mengarah ke "#"
//   karena file sejarah.html / visi-misi.html belum di-upload/dibuatkan.
// - Tombol login mahasiswa di halaman Beranda diarahkan ke route('login')
//   bawaan Breeze untuk sementara. Kalau kamu mau pakai desain
//   login_Mahasiswa.html yang terpisah, kabari nanti biar dibuatkan
//   halaman & route login khusus mahasiswa.
// - Tombol "login mentor" di halaman Beranda masih "#" (belum ada file
//   login mentor yang di-upload).
// --------------------------------------------------------------
