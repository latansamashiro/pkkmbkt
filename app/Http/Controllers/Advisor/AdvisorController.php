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
use App\Models\Task;
use App\Models\StudentTask;

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
        $studentIds = \App\Models\Member::whereIn('group_id', $groupIds)->pluck('student_id');

        $totalSesi = \App\Models\AttendanceTemplate::count();
        $totalSlot = $totalSesi * $studentIds->count();
        $hadirCount = \App\Models\AttendanceDetail::whereIn('student_id', $studentIds)
            ->where('status_presence', 'hadir')
            ->count();

        $stats = [
            'total_kelompok' => $groupIds->count(),
            'total_mentor' => Group::whereIn('id', $groupIds)->whereNotNull('mentor_id')->distinct('mentor_id')->count('mentor_id'),
            'total_mahasiswa' => $studentIds->count(),
            'rata_kehadiran' => $totalSlot > 0 ? (int) round($hadirCount / $totalSlot * 100) : 0,
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
        $tanggal = $request->query('tanggal');
        $cari = $request->query('cari');
        $groupIds = $this->myGroups()->pluck('id');

        $query = \App\Models\Attendance::selectRaw('group_id, attendance_date, COUNT(*) as jumlah_tercatat')
            ->whereIn('group_id', $groupIds)
            ->groupBy('group_id', 'attendance_date')
            ->orderByDesc('attendance_date');

        if ($tanggal) {
            $query->where('attendance_date', $tanggal);
        }

        $laporan = $query->get()->map(function ($row) {
            $group = Group::with('mentor')->find($row->group_id);
            $totalSesi = \App\Models\AttendanceTemplate::where('attendance_date', $row->attendance_date)->count();

            return [
                'group_id'   => $row->group_id,
                'oleh_label' => ($group->mentor->name ?? '-') . ' — ' . ($group->name ?? '-'),
                'tanggal'    => $row->attendance_date,
                'status'     => "{$row->jumlah_tercatat}/{$totalSesi} sesi tercatat",
            ];
        });

        if ($cari) {
            $laporan = $laporan->filter(
                fn ($r) => str_contains(strtolower($r['oleh_label']), strtolower($cari))
            )->values();
        }

        $filters = ['tanggal' => $tanggal, 'cari' => $cari];

        return view('role.advisor.monitoring-absensi.index', compact('laporan', 'filters'));
    }

    public function absensiDetail(Request $request, $groupId, $tanggal)
    {
        [$group, $tanggal, $sesiList, $matrix, $adaSubmitted] = array_values(
            $this->siapkanDataAbsensiDetail($groupId, $tanggal)
        );

        return view('role.advisor.monitoring-absensi.detail', compact('group', 'tanggal', 'sesiList', 'matrix', 'adaSubmitted'));
    }

    public function absensiExportPdf($groupId, $tanggal)
    {
        [$group, $tanggal, $sesiList, $matrix, $adaSubmitted] = array_values(
            $this->siapkanDataAbsensiDetail($groupId, $tanggal)
        );
        abort_unless($adaSubmitted, 403, 'Belum ada sesi yang disubmit untuk tanggal ini.');

        return view('role.admin.monitoring.absensi-print', compact('group', 'tanggal', 'sesiList', 'matrix'));
    }

    public function absensiExportExcel($groupId, $tanggal)
    {
        [$group, $tanggal, $sesiList, $matrix, $adaSubmitted] = array_values(
            $this->siapkanDataAbsensiDetail($groupId, $tanggal)
        );
        abort_unless($adaSubmitted, 403, 'Belum ada sesi yang disubmit untuk tanggal ini.');

        $namaFile = 'absensi_' . \Illuminate\Support\Str::slug($group->name) . '_' . $tanggal . '.csv';

        $callback = function () use ($sesiList, $matrix) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");

            $header = ['No', 'Mahasiswa'];
            foreach ($sesiList as $i => $sesi) {
                $header[] = 'Sesi ' . ($i + 1) . ' (' . ($sesi->template->session_name ?? '-') . ')';
            }
            $header[] = 'Kehadiran (%)';
            fputcsv($out, $header);

            $labelStatus = ['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alfa' => 'Alfa'];
            foreach ($matrix as $idx => $m) {
                $row = [$idx + 1, $m['nama']];
                foreach ($m['sesi'] as $status) {
                    $row[] = $labelStatus[$status] ?? '-';
                }
                $row[] = $m['persen'] . '%';
                fputcsv($out, $row);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$namaFile}\"",
        ]);
    }

    /**
     * Helper bareng buat absensiDetail()/absensiExportPdf()/absensiExportExcel() —
     * meniru App\Http\Controllers\Admin\MonitoringController::siapkanDataAbsensiDetail(),
     * cuma findOrFail-nya lewat myGroups() supaya advisor tidak bisa intip
     * kelompok yang bukan binaannya (404 kalau bukan).
     */
    protected function siapkanDataAbsensiDetail($groupId, $tanggal): array
    {
        $group = $this->myGroups()->with('mentor')->findOrFail($groupId);

        $sesiList = \App\Models\Attendance::with('template')
            ->where('group_id', $groupId)
            ->where('attendance_date', $tanggal)
            ->get()
            ->sortBy(fn ($a) => $a->template->time_begin ?? '')
            ->values();

        $adaSubmitted = $sesiList->contains(fn ($a) => $a->status === 'submitted');

        $matrix = Member::where('group_id', $groupId)
            ->with('student')
            ->get()
            ->map(function ($m) use ($sesiList) {
                $sesiStatus = $sesiList->map(function ($sesi) use ($m) {
                    $d = \App\Models\AttendanceDetail::where('attendance_id', $sesi->id)
                        ->where('student_id', $m->student_id)
                        ->first();
                    return $d->status_presence ?? '-';
                });

                $hadir  = $sesiStatus->filter(fn ($s) => $s === 'hadir')->count();
                $persen = $sesiList->count() ? round($hadir / $sesiList->count() * 100) : 0;

                return ['nama' => $m->student->name ?? '-', 'sesi' => $sesiStatus, 'persen' => $persen];
            });

        return compact('group', 'tanggal', 'sesiList', 'matrix', 'adaSubmitted');
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

    // ===== Monitoring Pengumpulan Tugas (scoped ke kelompok binaan) =====

    public function tugas(Request $request)
    {
        $cari = $request->query('cari');

        $tasks = Task::where('status', '!=', 'draft')->get();
        $totalTugas = $tasks->count();
        $taskIds = $tasks->pluck('id');

        $laporan = $this->myGroups()
            ->with('mentor')
            ->when($cari, fn ($q) => $q->where('name', 'like', "%{$cari}%"))
            ->get()
            ->map(function ($group) use ($taskIds, $totalTugas) {
                $studentIds = Member::where('group_id', $group->id)->pluck('student_id');
                $totalAnggota = $studentIds->count();
                $totalSlot = $totalAnggota * $totalTugas;

                $query = StudentTask::whereIn('student_id', $studentIds)
                    ->whereIn('task_id', $taskIds)
                    ->where('status', 'selesai');

                $selesai = (clone $query)->count();
                $updateTerakhir = (clone $query)->max('updated_at');

                $status = match (true) {
                    $selesai === 0 => 'Belum dimulai',
                    $totalSlot > 0 && $selesai >= $totalSlot => "Selesai {$selesai}/{$totalSlot}",
                    default => "Berjalan {$selesai}/{$totalSlot}",
                };

                return [
                    'group_id'   => $group->id,
                    'oleh_label' => ($group->mentor->name ?? '-') . ' — ' . $group->name,
                    'tanggal'    => $updateTerakhir,
                    'status'     => $status,
                ];
            })
            ->filter(fn ($g) => $g['tanggal'] !== null)
            ->values();

        $filters = compact('cari');

        return view('role.advisor.monitoring-tugas.index', compact('laporan', 'filters'));
    }

    public function tugasDetail($groupId)
    {
        [$group, $tasks, $rows] = array_values($this->siapkanDataTugasDetail($groupId));

        return view('role.advisor.monitoring-tugas.detail', compact('group', 'tasks', 'rows'));
    }

    public function tugasExportExcel($groupId)
    {
        [$group, $tasks, $rows] = array_values($this->siapkanDataTugasDetail($groupId));

        $namaFile = 'tugas_' . \Illuminate\Support\Str::slug($group->name) . '.csv';

        $callback = function () use ($tasks, $rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");

            $header = ['No', 'Mahasiswa', 'NPM'];
            foreach ($tasks as $t) {
                $jenisLabel = match ($t->task_type) {
                    'kelompok' => 'Kelompok',
                    'atk_almet' => 'ATK & Almet',
                    default => 'Individu',
                };
                $header[] = $t->title . ' (' . $jenisLabel . ')';
            }
            $header[] = 'Selesai';
            fputcsv($out, $header);

            foreach ($rows as $idx => $r) {
                $row = [$idx + 1, $r['nama'], $r['npm']];
                foreach ($tasks as $t) {
                    $row[] = ($r['tugas'][(string) $t->id] ?? false) ? 'Selesai' : 'Belum';
                }
                $row[] = "{$r['selesai']}/{$r['total']}";
                fputcsv($out, $row);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$namaFile}\"",
        ]);
    }

    /**
     * Helper bareng buat tugasDetail()/tugasExportExcel() — meniru
     * App\Http\Controllers\Admin\MonitoringController::siapkanDataTugasDetail(),
     * cuma findOrFail-nya lewat myGroups() supaya advisor tidak bisa intip
     * kelompok yang bukan binaannya (404 kalau bukan).
     */
    protected function siapkanDataTugasDetail($groupId): array
    {
        $group = $this->myGroups()->with('mentor')->findOrFail($groupId);

        $tasks = Task::where('status', '!=', 'draft')
            ->orderByRaw("FIELD(task_type, 'individu', 'kelompok', 'atk_almet')")
            ->orderBy('deadline')
            ->get();

        $studentIds = Member::where('group_id', $groupId)->pluck('student_id');

        $doneMap = StudentTask::whereIn('student_id', $studentIds)
            ->whereIn('task_id', $tasks->pluck('id'))
            ->where('status', 'selesai')
            ->get()
            ->groupBy('student_id')
            ->map(fn ($c) => $c->pluck('task_id')->all());

        $rows = Member::where('group_id', $groupId)
            ->with('student')
            ->get()
            ->map(function ($m) use ($tasks, $doneMap) {
                $doneIds = $doneMap->get($m->student_id, []);

                $tugas = $tasks->mapWithKeys(
                    fn ($t) => [(string) $t->id => in_array($t->id, $doneIds, true)]
                );

                return [
                    'nama'    => $m->student->name ?? '-',
                    'npm'     => $m->student->npm ?? '-',
                    'tugas'   => $tugas,
                    'selesai' => count($doneIds),
                    'total'   => $tasks->count(),
                ];
            })
            ->values();

        return compact('group', 'tasks', 'rows');
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

    /**
     * Leaderboard -- reuse view generik yang sama dengan Admin/Committee.
     */
    public function leaderboard()
    {
        $dataMahasiswa = \App\Support\Leaderboard::hitungRanking();

        return view('role.admin.leaderboard.index', compact('dataMahasiswa'));
    }
}