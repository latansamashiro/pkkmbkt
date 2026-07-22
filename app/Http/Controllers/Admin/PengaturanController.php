<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Sistem',
        ];
        return view('role.admin.pengaturan.index', compact('data'));
    }
}
