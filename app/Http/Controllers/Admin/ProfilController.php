<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Profil',
        ];
        return view('role.admin.profil.index', compact('data'));
    }
}
