<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Group;
use App\Models\Information;
use App\Models\Schedule;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = User::where('role_name', 'STUDENT')->count();
        $totalKelompok = Group::count();
        $totalJadwalHariIni = Schedule::whereDate('schedule_date', today())->count();

        // "Pelanggaran" belum punya kolom/tipe khusus di tabel activities,
        // jadi dihitung dari activity_value negatif (poin dikurangi = pelanggaran).
        // Ganti logic ini kalau nanti ada kolom kategori pelanggaran yang jelas.
        $totalPelanggaran = Activity::where('activity_value', '<', 0)->count();

        $jadwalTerdekat = Schedule::where('schedule_date', '>=', today())
            ->orderBy('schedule_date')
            ->orderBy('schedule_begin_time')
            ->take(5)
            ->get()
            ->map(fn($j) => [
                'tag' => $j->status ?? '-',
                'judul' => $j->title,
                'waktu' => \Carbon\Carbon::parse($j->schedule_date)->translatedFormat('d M Y') . ' • ' . substr($j->schedule_begin_time, 0, 5) . ' WIB',
                'icon' => 'calendar',
                'chip' => $j->important_flag ? 'chip-coral' : 'chip-navy',
            ])->all();

        $infoTerbaru = Information::latest()->take(5)->get()
            ->map(fn($i) => [
                'tag' => $i->category ?? '-',
                'judul' => $i->title,
                'waktu' => $i->created_at?->diffForHumans() ?? '-',
                'icon' => 'megaphone',
                'chip' => $i->important_flag ? 'chip-coral' : 'chip-teal',
            ])->all();

        $data = ['title' => 'Dashboard Panitia'];

        return view('role.committee.dashboard', compact(
            'data',
            'totalMahasiswa',
            'totalKelompok',
            'totalJadwalHariIni',
            'totalPelanggaran',
            'jadwalTerdekat',
            'infoTerbaru'
        ));
    }
}
