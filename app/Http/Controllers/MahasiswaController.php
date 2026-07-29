<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    /**
     * Halaman Modul.
     * NOTE: baru method ini yang ada. Method dashboard, profil, leaderboard,
     * info, evaluasi, dll akan ditambahkan saat grup "mahasiswa" dikerjakan.
     */
    public function modul()
    {
        return view('mahasiswa.modul');
    }
}
