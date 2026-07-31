<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function modul()
    {
        return view('role.student.modul');
    }

    public function leaderboard()
    {
        return view('role.student.leaderboard');
    }

    public function info()
    {
        return view('role.student.info');
    }

    public function profil()
    {
        return view('role.student.profil');
    }

    public function jadwal()
    {
        return view('role.student.jadwal');
    }

    public function keaktifan()
    {
        return view('role.student.keaktifan');
    }

    public function materi()
    {
        return view('role.student.materi');
    }

    public function denahKampus()
    {
        return view('role.student.denah-kampus');
    }

    public function evaluasi()
    {
        return view('role.student.evaluasi');
    }

    public function absensi()
    {
        return view('role.student.absensi');
    }
}
