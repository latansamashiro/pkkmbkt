<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    /** Splash screen — halaman paling pertama muncul (route: /) */
    public function index()
    {
        return view('landing.index');
    }

    /** Home page utama setelah splash (route: /home) */
    public function home()
    {
        return view('landing.home');
    }

    public function sejarah()
    {
        return view('landing.sejarah');
    }

    public function visiMisi()
    {
        return view('landing.visi-misi');
    }

    public function tentangKami()
    {
        return view('landing.tentang-kami');
    }

    public function informasi()
    {
        return view('landing.informasi');
    }

    public function kontak()
    {
        return view('landing.kontak');
    }
}
