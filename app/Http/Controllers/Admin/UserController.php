<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Pengguna',
        ];
        return view('role.admin.user.index', compact('data'));
    }
}
