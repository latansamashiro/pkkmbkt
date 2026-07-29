<?php

use App\Http\Controllers\LandingController;

// ==========================================================
// RUTE HALAMAN DEPAN (LANDING) — tempel di routes/web.php,
// GANTIKAN route "/" bawaan Laravel (Route::view('/', 'welcome')).
// Jangan ubah/hapus rute login, register, dashboard, dll milik
// sistem auth yang sudah kamu punya — biarkan tetap ada.
// ==========================================================

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/home', [LandingController::class, 'home'])->name('landing.home');
Route::get('/sejarah', [LandingController::class, 'sejarah'])->name('landing.sejarah');
Route::get('/visi-misi', [LandingController::class, 'visiMisi'])->name('landing.visi-misi');
Route::get('/tentang-kami', [LandingController::class, 'tentangKami'])->name('landing.tentang-kami');
Route::get('/informasi', [LandingController::class, 'informasi'])->name('landing.informasi');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('landing.kontak');
