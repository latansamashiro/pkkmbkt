<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataMasterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Data Master',
        ];
        return view('role.admin.data-master.index', compact('data'));
    }
}
