<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * ASUMSI YANG PERLU DICEK:
 * 1. Tabel `groups` punya kolom `advisor_id` (FK ke users.id, role ADVISOR).
 *    Kalau nama kolomnya beda (mis. `pembimbing_id` / `koordinator_id`),
 *    tinggal ganti semua `advisor_id` di file ini.
 * 2. Relasi Group::mentor() dan Group::members() sudah ada (dipakai juga
 *    di halaman Admin/Panitia yang sudah jalan). kelompokBinaanDetail()
 *    juga asumsikan Member punya relasi student() belongsTo(User) — kalau
 *    nama relasinya beda, sesuaikan ->with(['members.student']) dan
 *    ->pluck('student') di method itu.
 * 3. Method absensi()/absensiDetail()/export* di sini meniru struktur data
 *    yang dipakai view (absensi.blade.php & absensi-detail.blade.php),
 *    tapi query aslinya masih perlu disamakan dengan
 *    App\Http\Controllers\Admin\MonitoringController — kirim isi controller
 *    itu supaya saya bisa pastikan logikanya identik, cuma discope ke
 *    kelompok binaan advisor.
 */
class AdvisorController extends Controller
{
    protected function myGroups()
    {
        return Group::where('advisor_id', Auth::id());
    }

    public function dashboard()
    {
        $groupIds = $this->myGroups()->pluck('id');

        $stats = [
            'total_kelompok' => $groupIds->count(),
            'total_mentor' => Group::whereIn('id', $groupIds)->whereNotNull('mentor_id')->distinct('mentor_id')->count('mentor_id'),
            'total_mahasiswa' => \App\Models\Member::whereIn('group_id', $groupIds)->count(),
            'rata_kehadiran' => null, // TODO: hitung dari data absensi setelah query absensi difinalkan
        ];

        return view('role.advisor.dashboard', compact('stats'));
    }

    public function kelompokBinaan(Request $request)
    {
        $cari = $request->query('cari');

        $kelompok = $this->myGroups()
            ->with(['mentor', 'members'])
            ->when($cari, function ($q) use ($cari) {
                $q->where(function ($qq) use ($cari) {
                    $qq->where('name', 'like', "%{$cari}%")
                        ->orWhereHas('mentor', fn($m) => $m->where('name', 'like', "%{$cari}%"));
                });
            })
            ->orderBy('name')
            ->get();

        $filters = ['cari' => $cari];

        return view('role.advisor.kelompok-binaan.index', compact('kelompok', 'filters'));
    }

    public function kelompokBinaanDetail($id)
    {
        $kelompok = $this->myGroups()->with(['mentor', 'members.student'])->findOrFail($id);

        // Member = baris pivot (group_id, student_id); ambil data mahasiswa (User) di baliknya.
        $anggota = $kelompok->members->pluck('student')->filter()->values();

        return view('role.advisor.kelompok-binaan.detail', compact('kelompok', 'anggota'));
    }

    // ===== Monitoring Absensi (scoped ke kelompok binaan) =====
    // Struktur data di bawah ini mengikuti apa yang dipakai view; query aslinya
    // (join sesi/template/absensi) perlu disamakan dengan Admin\MonitoringController.

    public function absensi(Request $request)
    {
        $tanggal = $request->query('tanggal', now()->toDateString());
        $cari = $request->query('cari');
        $groupIds = $this->myGroups()->pluck('id');

        // TODO: ganti dengan query asli dari Admin\MonitoringController::absensi(),
        // ditambah ->whereIn('group_id', $groupIds)
        $laporan = collect(); // isi: ['oleh_label' => ..., 'group_id' => ..., 'tanggal' => ..., 'status' => ...]

        $filters = ['tanggal' => $tanggal, 'cari' => $cari];

        return view('role.advisor.monitoring-absensi.index', compact('laporan', 'filters'));
    }

    public function absensiDetail(Request $request, $groupId, $tanggal)
    {
        $group = $this->myGroups()->with('mentor')->findOrFail($groupId);

        // TODO: ganti dengan query asli dari Admin\MonitoringController::absensiDetail()
        $sesiList = collect();
        $matrix = collect();
        $adaSubmitted = false;

        return view('role.advisor.monitoring-absensi.detail', compact('group', 'tanggal', 'sesiList', 'matrix', 'adaSubmitted'));
    }

    public function absensiExportPdf($groupId, $tanggal)
    {
        $group = $this->myGroups()->findOrFail($groupId);
        // TODO: reuse App\Http\Controllers\Admin\MonitoringController::absensiExportPdf() logic
        abort(501, 'Export PDF belum dihubungkan — sesuaikan dengan logika di Admin\\MonitoringController.');
    }

    public function absensiExportExcel($groupId, $tanggal)
    {
        $group = $this->myGroups()->findOrFail($groupId);
        // TODO: reuse App\Http\Controllers\Admin\MonitoringController::absensiExportExcel() logic
        abort(501, 'Export Excel belum dihubungkan — sesuaikan dengan logika di Admin\\MonitoringController.');
    }

    // ===== Profil =====

    public function profil()
    {
        return view('role.advisor.profil.index');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'phone_no' => ['nullable', 'string', 'max:20'],
        ]);

        $user = Auth::user();
        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Auth::user()->update(['password' => Hash::make($validated['password'])]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}