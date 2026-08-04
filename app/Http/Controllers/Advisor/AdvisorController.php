<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Activity;
use App\Models\Evaluation;
use App\Models\EvaluationCategory;
use App\Models\Member;

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

    // ===== Monitoring Evaluasi (scoped ke kelompok binaan) =====

    public function evaluasi(Request $request)
    {
        $cari = $request->query('cari');

        $laporan = $this->myGroups()
            ->with('mentor')
            ->when($cari, fn ($q) => $q->where('name', 'like', "%{$cari}%"))
            ->get()
            ->map(function ($group) {
                $totalAnggota = Member::where('group_id', $group->id)->count();
                $studentIds = Member::where('group_id', $group->id)->pluck('student_id');

                $sudahIsi = Evaluation::whereIn('student_id', $studentIds)
                    ->whereNotNull('status')
                    ->where('status', '!=', 'Belum Mengisi')
                    ->count();

                $tanggalTerakhir = Evaluation::whereIn('student_id', $studentIds)->max('updated_at');

                $status = match (true) {
                    $sudahIsi === 0 => 'Belum dimulai',
                    $sudahIsi >= $totalAnggota && $totalAnggota > 0 => "Selesai {$sudahIsi}/{$totalAnggota}",
                    default => "Berjalan {$sudahIsi}/{$totalAnggota}",
                };

                return [
                    'group_id'   => $group->id,
                    'oleh_label' => ($group->mentor->name ?? '-') . ' — ' . $group->name,
                    'tanggal'    => $tanggalTerakhir,
                    'status'     => $status,
                ];
            })
            ->filter(fn ($g) => $g['tanggal'] !== null)
            ->values();

        $filters = compact('cari');

        return view('role.advisor.monitoring-evaluasi.index', compact('laporan', 'filters'));
    }

    public function evaluasiDetail($groupId)
    {
        // findOrFail lewat myGroups() -> 404 kalau kelompok ini bukan binaan advisor ini
        $group = $this->myGroups()->with('mentor')->findOrFail($groupId);

        $categories = EvaluationCategory::orderBy('urutan')->get();
        $studentIds = Member::where('group_id', $groupId)->pluck('student_id');

        $evaluations = Evaluation::whereIn('student_id', $studentIds)
            ->with('details')
            ->get()
            ->keyBy('student_id');

        $rows = Member::where('group_id', $groupId)
            ->with('student')
            ->get()
            ->map(function ($m) use ($categories, $evaluations) {
                $evaluation = $evaluations->get($m->student_id);
                $detailByCategory = $evaluation ? $evaluation->details->keyBy('evaluation_category_id') : collect();

                $nilai = $categories->mapWithKeys(
                    fn ($cat) => [$cat->id => $detailByCategory->get($cat->id)?->value]
                );

                return [
                    'nama'   => $m->student->name ?? '-',
                    'nilai'  => $nilai,
                    'rata'   => $evaluation?->rata_rata,
                    'status' => $evaluation->status ?? 'Belum Mengisi',
                ];
            });

        return view('role.advisor.monitoring-evaluasi.detail', compact('group', 'categories', 'rows'));
    }

    // ===== Monitoring Keaktifan & Pelanggaran (scoped ke kelompok binaan) =====

    public function keaktifan(Request $request)
    {
        return $this->poinListingAdvisor($request, 'keaktifan');
    }

    public function pelanggaran(Request $request)
    {
        return $this->poinListingAdvisor($request, 'pelanggaran');
    }

    public function keaktifanDetail($groupId)
    {
        return $this->poinDetailAdvisor($groupId, 'keaktifan');
    }

    public function pelanggaranDetail($groupId)
    {
        return $this->poinDetailAdvisor($groupId, 'pelanggaran');
    }

    protected function poinListingAdvisor(Request $request, string $tipe)
    {
        $cari = $request->query('cari');
        $isKeaktifan = $tipe === 'keaktifan';

        $laporan = $this->myGroups()
            ->when($cari, fn ($q) => $q->where('name', 'like', "%{$cari}%"))
            ->get()
            ->map(function ($group) use ($isKeaktifan) {
                $studentIds = Member::where('group_id', $group->id)->pluck('student_id');

                $query = Activity::whereIn('student_id', $studentIds)
                    ->when($isKeaktifan, fn ($q) => $q->where('activity_value', '>', 0))
                    ->when(!$isKeaktifan, fn ($q) => $q->where('activity_value', '<', 0));

                return [
                    'group_id' => $group->id,
                    'kelompok' => $group->name,
                    'poin'     => (clone $query)->sum('activity_value'),
                    'update'   => (clone $query)->max('updated_at'),
                ];
            })
            ->filter(fn ($g) => $g['update'] !== null)
            ->values();

        $filters = compact('cari');
        $view = $tipe === 'keaktifan'
            ? 'role.advisor.monitoring-keaktifan.index'
            : 'role.advisor.monitoring-pelanggaran.index';

        return view($view, compact('laporan', 'filters'));
    }

    protected function poinDetailAdvisor($groupId, string $tipe)
    {
        $group = $this->myGroups()->with('mentor')->findOrFail($groupId);
        $isKeaktifan = $tipe === 'keaktifan';

        $rows = Member::where('group_id', $groupId)
            ->with('student')
            ->get()
            ->map(function ($m) use ($isKeaktifan) {
                $query = Activity::where('student_id', $m->student_id)
                    ->when($isKeaktifan, fn ($q) => $q->where('activity_value', '>', 0))
                    ->when(!$isKeaktifan, fn ($q) => $q->where('activity_value', '<', 0));

                $terakhir = (clone $query)->orderByDesc('created_at')->first();

                return [
                    'nama'       => $m->student->name ?? '-',
                    'poin'       => (clone $query)->sum('activity_value'),
                    'update'     => $terakhir->updated_at ?? null,
                    'keterangan' => $terakhir->description ?? '-',
                ];
            })
            ->filter(fn ($r) => $r['update'] !== null)
            ->values();

        $view = $tipe === 'keaktifan'
            ? 'role.advisor.monitoring-keaktifan.detail'
            : 'role.advisor.monitoring-pelanggaran.detail';

        return view($view, compact('group', 'rows', 'tipe'));
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