<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('role.committee.dashboard');
    }
}