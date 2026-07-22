<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Role & Hak Akses',
        ];
        return view('role.admin.role.index', compact('data'));
    }
}
