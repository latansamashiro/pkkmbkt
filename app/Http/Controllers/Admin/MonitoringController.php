<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function pkkmb()
    {
        $data = [
            'title' => 'Monitoring PKKMB',
        ];
        return view('role.admin.monitoring.pkkmb', compact('data'));
    }

    public function laporan()
    {
        $data = [
            'title' => 'Monitoring Laporan',
        ];
        return view('role.admin.monitoring.laporan', compact('data'));
    }
}
