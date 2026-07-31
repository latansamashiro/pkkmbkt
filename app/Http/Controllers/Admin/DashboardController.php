<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Titik masuk netral "/dashboard".
     * Melempar ke tampilan dashboard sesuai role_name user yang login.
     * Dashboard ADVISOR, MENTOR, STUDENT, COMMITTEE masih placeholder
     * (menyusul, tinggal ganti isi view-nya di resources/views/role/{role}/dashboard.blade.php).
     */
    public function index()
    {
        $role = strtoupper(trim(auth()->user()->role_name ?? ''));

        return match ($role) {
            'SUPER-ADMIN' => $this->superAdmin(),
            'ADVISOR'     => view('role.advisor.dashboard'),
            'MENTOR'      => view('role.mentor.dashboard'),
            'STUDENT'     => view('role.student.dashboard'),
            'COMMITTEE'   => view('role.committee.dashboard'),
            default       => abort(403, 'Role akun tidak dikenali: "' . auth()->user()->role_name . '"'),
        };
    }

    /**
     * Dashboard khusus SUPER-ADMIN (logic lama, tidak diubah).
     */
    protected function superAdmin()
    {
        // Total Pengguna: semua akun di tabel users (SUPER-ADMIN, ADVISOR, MENTOR, STUDENT, COMMITTEE)
        $totalPengguna = User::count();

        // Total Role: jumlah role yang terdaftar di sistem (lihat UserController::ROLES)
        $totalRole = count(UserController::ROLES);

        // Data Master: total gabungan semua kategori data master (Kelompok, Modul, Topik, Jadwal, Informasi, Evaluasi)
        $totalDataMaster = collect(DataMasterController::types())
            ->sum(fn($cfg) => $cfg['model']::count());

        // Laporan: dihitung dari data absensi (attendances).
        // Kalau nanti kamu punya model/tabel "laporan" tersendiri, tinggal ganti baris ini.
        $totalLaporan = Attendance::count();

        // Ringkasan Role -> jumlah pengguna per role, buat kartu "Ringkasan Role"
        $ringkasanRole = collect(UserController::ROLES)->map(function ($label, $key) {
            return [
                'tag' => $key,
                'judul' => $label,
                'waktu' => User::where('role_name', $key)->count() . ' pengguna',
                'icon' => 'user',
                'chip' => 'chip-navy',
            ];
        })->values()->all();

        // Aktivitas Terbaru -> 5 pengguna yang paling baru terdaftar
        $aktivitasTerbaru = User::latest()->take(5)->get(['name', 'role_name', 'created_at'])
            ->map(function ($u) {
                $labelRole = UserController::ROLES[$u->role_name] ?? $u->role_name;
                return [
                    'tag' => 'Pengguna Baru',
                    'judul' => $u->name . ' terdaftar sebagai ' . $labelRole,
                    'waktu' => $u->created_at?->diffForHumans() ?? '-',
                    'icon' => 'user-plus',
                    'chip' => 'chip-teal',
                ];
            })->all();

        $data = ['title' => 'Dashboard'];

        return view('role.admin.dashboard', compact(
            'data',
            'totalPengguna',
            'totalRole',
            'totalDataMaster',
            'totalLaporan',
            'aktivitasTerbaru',
            'ringkasanRole'
        ));
    }
}
