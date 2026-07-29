<?php

namespace App\Http\Controllers;

class PublicController extends Controller
{
    public function splash()
    {
        return view('public.splash');
    }

    public function home()
    {
        return view('public.home');
    }

    public function informasi()
    {
        return view('public.informasi');
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    public function jadwal()
    {
        return view('public.jadwal');
    }
}
