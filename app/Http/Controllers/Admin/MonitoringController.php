<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\AttendanceTemplate;
use App\Models\Exam;
use App\Models\Faculty;
use App\Models\StudentExam;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Member;
use App\Models\Evaluation;
use App\Models\EvaluationCategory;
use App\Models\EvaluationDetail;
use App\Models\Task;
use App\Models\StudentTask;

class MonitoringController extends Controller
{
    public function pkkmb(Request $request)
    {
        $tahun    = $request->input('tahun', now()->year);
        $fakultas = $request->input('fakultas');
        $hari     = $request->input('hari');

        $studentQuery = User::where('role_name', 'STUDENT');
        if ($fakultas) {
            $studentQuery->where('faculty_name', $fakultas);
        }
        $studentIds = $studentQuery->pluck('id');

        $totalMaba = $studentIds->count();

        $attendanceDetailQuery = AttendanceDetail::whereIn('student_id', $studentIds)
            ->whereHas('attendance.template', function ($q) use ($hari) {
                if ($hari) {
                    $q->where('day_name', $hari);
                }
            });

        $hadir = (clone $attendanceDetailQuery)->where('status_presence', 'hadir')->count();
        $tidakHadir = (clone $attendanceDetailQuery)->where('status_presence', '!=', 'hadir')->count();

        $mentorAktif = User::where('role_name', 'MENTOR')
            ->where('status', 'aktif')
            ->count();

        $evaluasiSelesai = null;

        // sama persis pola di UserController::index() -- buat isi dropdown Fakultas
        $faculties = Faculty::orderBy('name')->get(['id', 'name']);

        $data = [
            'title' => 'Monitoring PKKMB',
            'stats' => [
                'totalMaba'       => $totalMaba,
                'hadir'           => $hadir,
                'tidakHadir'      => $tidakHadir,
                'evaluasiSelesai' => $evaluasiSelesai,
                'mentorAktif'     => $mentorAktif,
            ],
            'filters' => compact('tahun', 'fakultas', 'hari'),
        ];

        return view('role.admin.monitoring.pkkmb', [
            'data'      => $data,
            'faculties' => $faculties,
        ]);
    }

  
    public function laporan(Request $request)
{
    $jenis   = $request->input('jenis');
    $tanggal = $request->input('tanggal');
    $cari    = $request->input('cari');

    // 1. Absensi -- dari attendances + attendance_details
    $absensi = Attendance::with(['template', 'group'])
        ->get()
        ->map(function ($a) {
            $totalDetail  = $a->details()->count();
            $hadirDetail  = $a->details()->where('status_presence', 'hadir')->count();
            return [
                'jenis'      => 'Absensi',
                'oleh_label' => $a->group->name ?? '-',
                'tanggal'    => optional($a->attendance_date)->format('Y-m-d') ?? $a->attendance_date,
                'status'     => $totalDetail > 0 && $hadirDetail === $totalDetail ? 'Selesai' : 'Diproses',
                'ref_type'   => 'attendance',
                'ref_id'     => $a->id,
                'group_id'   => $a->group_id,
                'submitted'  => $a->status === 'submitted',
            ];
        });

    // 2. Evaluasi -- dari exams + student_exams (inferensi: terjawab >= max_question)
    $evaluasi = Exam::all()->flatMap(function ($exam) {
        return StudentExam::where('exam_id', $exam->id)
            ->select('student_id')
            ->distinct()
            ->get()
            ->map(function ($row) use ($exam) {
                $dijawab = StudentExam::where('exam_id', $exam->id)
                    ->where('student_id', $row->student_id)
                    ->distinct('exam_detail_id')
                    ->count('exam_detail_id');
                $student = User::find($row->student_id);
                return [
                    'jenis'      => 'Evaluasi',
                    'oleh_label' => $student->name ?? '-',
                    'tanggal'    => $exam->updated_at->format('Y-m-d'),
                    'status'     => $dijawab >= $exam->max_question ? 'Selesai' : 'Diproses',
                    'ref_type'   => 'exam',
                    'ref_id'     => $exam->id,
                    'group_id'   => \App\Models\Member::where('student_id', $row->student_id)->value('group_id'),
                ];
            });
    });

  // 3. Keaktifan (poin plus) -- dari activities, activity_value > 0
    $keaktifan = Activity::with('student')
        ->where('activity_value', '>', 0)
        ->get()
        ->map(fn ($act) => [
            'jenis'      => 'Keaktifan',
            'oleh_label' => $act->student->name ?? '-',
            'tanggal'    => $act->created_at->format('Y-m-d'),
            'status'     => 'Selesai',
            'ref_type'   => 'activity',
            'ref_id'     => $act->id,
            'group_id'   => \App\Models\Member::where('student_id', $act->student_id)->value('group_id'),
        ]);

    // 4. Pelanggaran (poin minus) -- dari activities juga, activity_value < 0
    $pelanggaran = Activity::with(['student', 'createdBy'])
        ->where('activity_value', '<', 0)
        ->get()
        ->map(fn ($act) => [
            'jenis'      => 'Pelanggaran',
            'oleh_label' => $act->createdBy->name ?? '-', // "dicatat mentor", bukan nama mahasiswa
            'tanggal'    => $act->created_at->format('Y-m-d'),
            'status'     => 'Selesai',
            'ref_type'   => 'activity',
            'ref_id'     => $act->id,
            'group_id'   => \App\Models\Member::where('student_id', $act->student_id)->value('group_id'),
        ]);

    // gabung + filter + search
    $laporan = collect($absensi)->concat($evaluasi)->concat($keaktifan)->concat($pelanggaran)
        ->when($jenis, fn ($c) => $c->where('jenis', $jenis))
        ->when($tanggal, fn ($c) => $c->where('tanggal', $tanggal))
        ->when($cari, fn ($c) => $c->filter(fn ($row) =>
            str_contains(strtolower($row['jenis']), strtolower($cari)) ||
            str_contains(strtolower($row['oleh_label']), strtolower($cari))
        ))
        ->sortByDesc('tanggal')
        ->values();

    // pagination manual (data-nya Collection, bukan Eloquent builder)
    $perPage = 10;
    $page = $request->input('page', 1);
    $paged = $laporan->forPage($page, $perPage)->values();
    $totalPage = max(1, ceil($laporan->count() / $perPage));

    $data = ['title' => $request->route('title') ?? 'Monitoring Laporan'];

    return view($request->route('view') ?? 'role.admin.monitoring.laporan', [
        'data'      => $data,
        'laporan'   => $paged,
        'total'     => $laporan->count(),
        'page'      => (int) $page,
        'totalPage' => $totalPage,
        'perPage'   => $perPage,
        'filters'   => compact('jenis', 'tanggal', 'cari'),
    ]);
}
public function absensi(Request $request)
{
    $tanggal = $request->input('tanggal');
    $cari    = $request->input('cari');

    $query = Attendance::selectRaw('group_id, attendance_date, COUNT(*) as jumlah_tercatat')
        ->groupBy('group_id', 'attendance_date')
        ->orderByDesc('attendance_date');

    if ($tanggal) {
        $query->where('attendance_date', $tanggal);
    }

    $laporan = $query->get()->map(function ($row) {
        $group = Group::with('mentor')->find($row->group_id);
        $totalSesi = AttendanceTemplate::where('attendance_date', $row->attendance_date)->count();

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

    return view($request->route('view') ?? 'role.admin.monitoring.absensi', [
        'data'    => ['title' => $request->route('title') ?? 'Monitoring Absensi'],
        'laporan' => $laporan,
        'filters' => compact('tanggal', 'cari'),
    ]);
}

public function absensiDetail(Request $request, $groupId, $tanggal)
{
    $group = Group::with('mentor')->findOrFail($groupId);

    $sesiList = Attendance::with('template')
        ->where('group_id', $groupId)
        ->where('attendance_date', $tanggal)
        ->get()
        ->sortBy(fn ($a) => $a->template->time_begin ?? '')
        ->values();

    // Export PDF/Excel cuma boleh kalau minimal satu sesi di tanggal ini sudah disubmit
    // (data draft belum final, belum layak jadi laporan resmi).
    $adaSubmitted = $sesiList->contains(fn ($a) => $a->status === 'submitted');

    $matrix = Member::where('group_id', $groupId)
        ->with('student')
        ->get()
        ->map(function ($m) use ($sesiList) {
            $sesiStatus = $sesiList->map(function ($sesi) use ($m) {
                $d = AttendanceDetail::where('attendance_id', $sesi->id)
                    ->where('student_id', $m->student_id)
                    ->first();
                return $d->status_presence ?? '-';
            });

            $hadir  = $sesiStatus->filter(fn ($s) => $s === 'hadir')->count();
            $persen = $sesiList->count() ? round($hadir / $sesiList->count() * 100) : 0;

            return [
                'nama'   => $m->student->name ?? '-',
                'sesi'   => $sesiStatus,
                'persen' => $persen,
            ];
        });

    return view('role.admin.monitoring.absensi-detail', compact('group', 'tanggal', 'sesiList', 'matrix', 'adaSubmitted'));
}

/**
 * Halaman cetak (letterhead) untuk Export PDF — dibuka di tab baru,
 * tinggal Ctrl+P / tombol Print di halaman itu untuk simpan sebagai PDF.
 */
public function absensiExportPdf($groupId, $tanggal)
{
    [$group, $tanggal, $sesiList, $matrix, $adaSubmitted] = array_values(
        $this->siapkanDataAbsensiDetail($groupId, $tanggal)
    );
    abort_unless($adaSubmitted, 403, 'Belum ada sesi yang disubmit untuk tanggal ini.');

    return view('role.admin.monitoring.absensi-print', compact('group', 'tanggal', 'sesiList', 'matrix'));
}

/**
 * Export Excel (CSV) — dibuka Excel/Sheets langsung karena formatnya .csv.
 */
public function absensiExportExcel($groupId, $tanggal)
{
    [$group, $tanggal, $sesiList, $matrix, $adaSubmitted] = array_values(
        $this->siapkanDataAbsensiDetail($groupId, $tanggal)
    );
    abort_unless($adaSubmitted, 403, 'Belum ada sesi yang disubmit untuk tanggal ini.');

    $namaFile = 'absensi_' . \Illuminate\Support\Str::slug($group->name) . '_' . $tanggal . '.csv';

    $callback = function () use ($sesiList, $matrix) {
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF"); // BOM biar Excel baca UTF-8 dengan benar

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
            fputcsv($out, $this->netralkanBarisCsv($row));
        }
        fclose($out);
    };

    return response()->stream($callback, 200, [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => "attachment; filename=\"{$namaFile}\"",
    ]);
}

/**
 * Helper bareng buat absensiExportPdf() & absensiExportExcel() supaya
 * tidak duplikasi query dari absensiDetail().
 */
protected function siapkanDataAbsensiDetail($groupId, $tanggal): array
{
    $group = Group::with('mentor')->findOrFail($groupId);

    $sesiList = Attendance::with('template')
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
                $d = AttendanceDetail::where('attendance_id', $sesi->id)
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
public function keaktifan(Request $request)
{
    return $this->poinListing($request, 'keaktifan');
}

public function pelanggaran(Request $request)
{
    return $this->poinListing($request, 'pelanggaran');
}

public function keaktifanDetail(Request $request, $groupId)
{
    return $this->poinDetail($request, $groupId, 'keaktifan');
}

public function pelanggaranDetail(Request $request, $groupId)
{
    return $this->poinDetail($request, $groupId, 'pelanggaran');
}

protected function poinListing(Request $request, string $tipe)
{
    $cari = $request->input('cari');
    $isKeaktifan = $tipe === 'keaktifan';

    $groups = Group::query()
        ->when($cari, fn ($q) => $q->where('name', 'like', "%{$cari}%"))
        ->get()
        ->map(function ($group) use ($isKeaktifan) {
            $studentIds = Member::where('group_id', $group->id)->pluck('student_id');

            $query = Activity::whereIn('student_id', $studentIds)
                ->when($isKeaktifan, fn ($q) => $q->where('activity_value', '>', 0))
                ->when(!$isKeaktifan, fn ($q) => $q->where('activity_value', '<', 0));

            return [
                'group_id'  => $group->id,
                'kelompok'  => $group->name,
                'poin'      => (clone $query)->sum('activity_value'),
                'update'    => (clone $query)->max('updated_at'),
            ];
        })
        ->filter(fn ($g) => $g['update'] !== null) // sembunyiin kelompok yang belum ada record
        ->values();

    return view($request->route('view') ?? "role.admin.monitoring.{$tipe}", [
        'data'    => ['title' => $request->route('title') ?? 'Monitoring ' . ucfirst($tipe)],
        'laporan' => $groups,
        'filters' => compact('cari'),
        'tipe'    => $tipe,
    ]);
}

protected function poinDetail(Request $request, $groupId, string $tipe)
{
    $group = Group::with('mentor')->findOrFail($groupId);
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

    return view($request->route('view') ?? "role.admin.monitoring.{$tipe}-detail", compact('group', 'rows', 'tipe'));
}

public function evaluasi(Request $request)
{
    $cari = $request->input('cari');

    // Paket Evaluasi (Exam/kuis) yang mahasiswa kerjakan sendiri -- BUKAN
    // EvaluationCategory (itu sistem rubrik terpisah, gak ada isinya).
    $examIds = Exam::pluck('id');
    $totalExams = $examIds->count();

    $groups = Group::with('mentor')
        ->when($cari, fn ($q) => $q->where('name', 'like', "%{$cari}%"))
        ->get()
        ->map(function ($group) use ($examIds, $totalExams) {
            $totalAnggota = Member::where('group_id', $group->id)->count();
            $studentIds   = Member::where('group_id', $group->id)->pluck('student_id');

            // "Sudah isi" = mahasiswa yang sudah pernah kirim hasil minimal 1 paket evaluasi.
            $sudahIsi = StudentExam::whereIn('student_id', $studentIds)
                ->whereIn('exam_id', $examIds)
                ->distinct('student_id')
                ->count('student_id');

            $tanggalTerakhir = StudentExam::whereIn('student_id', $studentIds)
                ->whereIn('exam_id', $examIds)
                ->max('updated_at');

            $status = match(true) {
                $totalExams === 0 => 'Belum ada paket evaluasi',
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
        ->values(); // TIDAK di-filter lagi -- semua kelompok tetap tampil, termasuk yang belum ada evaluasi sama sekali

    return view($request->route('view') ?? 'role.admin.monitoring.evaluasi', [
        'data'    => ['title' => $request->route('title') ?? 'Monitoring Evaluasi'],
        'laporan' => $groups,
        'filters' => compact('cari'),
    ]);
}

public function evaluasiDetail(Request $request, $groupId)
{
    $group = Group::with('mentor')->findOrFail($groupId);

    // "categories" di view generik ini sekarang isinya daftar Paket Evaluasi
    // (Exam) -- tiap paket jadi 1 kolom, sama kayak kategori rubrik dulu.
    $categories = Exam::with('details')->orderBy('title')->get();

    $studentIds = Member::where('group_id', $groupId)->pluck('student_id');

    // Skor tiap paket = RATA-RATA semua percobaan yang sudah diselesaikan
    // mahasiswa (bukan lagi jawaban mentah percobaan terakhir doang).
    $skorAttemptSemua = \App\Models\ExamAttemptScore::whereIn('student_id', $studentIds)
        ->whereIn('exam_id', $categories->pluck('id'))
        ->get()
        ->groupBy(fn ($r) => $r->student_id . '-' . $r->exam_id)
        ->map(fn ($grup) => $grup->pluck('skor'));

    $rows = Member::where('group_id', $groupId)
        ->with('student')
        ->get()
        ->map(function ($m) use ($categories, $skorAttemptSemua) {
            $nilai = [];
            $skorList = [];
            $adaYangBelumLulus = false;
            $sudahMengisi = false;

            foreach ($categories as $exam) {
                $skorAttemptExamIni = $skorAttemptSemua->get($m->student_id . '-' . $exam->id);
                if (!\App\Support\ExamScoring::sudahDikerjakan($skorAttemptExamIni)) {
                    $nilai[$exam->id] = null;
                    continue;
                }

                $sudahMengisi = true;
                $skor = \App\Support\ExamScoring::rataRata($skorAttemptExamIni);
                $nilai[$exam->id] = $skor;
                $skorList[] = $skor;
                if ($skor < $exam->passing_grade) {
                    $adaYangBelumLulus = true;
                }
            }

            $rata = count($skorList) ? (int) round(array_sum($skorList) / count($skorList)) : null;
            $status = !$sudahMengisi ? 'Belum Mengisi' : ($adaYangBelumLulus ? 'Belum Lulus' : 'Lulus');

            return [
                'nama'   => $m->student->name ?? '-',
                'nilai'  => $nilai,
                'rata'   => $rata,
                'status' => $status,
            ];
        });

    return view($request->route('view') ?? 'role.admin.monitoring.evaluasi-detail', compact('group', 'categories', 'rows'));
}

// ===== Monitoring Pengumpulan Tugas =====

public function tugas(Request $request)
{
    $cari = $request->input('cari');

    $tasks = Task::where('status', '!=', 'draft')->get();
    $totalTugas = $tasks->count();
    $taskIds = $tasks->pluck('id');

    $groups = Group::with('mentor')
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
        ->values(); // semua kelompok tetap tampil, termasuk yang belum ada aktivitas tugas sama sekali

    return view($request->route('view') ?? 'role.admin.monitoring.tugas', [
        'data'    => ['title' => $request->route('title') ?? 'Monitoring Pengumpulan Tugas'],
        'laporan' => $groups,
        'filters' => compact('cari'),
    ]);
}

public function tugasDetail(Request $request, $groupId)
{
    [$group, $tasks, $rows] = array_values($this->siapkanDataTugasDetail($groupId));

    return view($request->route('view') ?? 'role.admin.monitoring.tugas-detail', compact('group', 'tasks', 'rows'));
}

/**
 * Export Excel (CSV) buat rekap pengumpulan tugas 1 kelompok.
 */
public function tugasExportExcel($groupId)
{
    [$group, $tasks, $rows] = array_values($this->siapkanDataTugasDetail($groupId));

    $namaFile = 'tugas_' . \Illuminate\Support\Str::slug($group->name) . '.csv';

    $callback = function () use ($tasks, $rows) {
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF"); // BOM biar Excel baca UTF-8 dengan benar

        $header = ['No', 'Mahasiswa', 'NPM'];
        foreach ($tasks as $t) {
            $jenisLabel = match ($t->task_type) {
                'kelompok' => 'Kelompok',
                'atk' => 'Penerimaan ATK',
                'jas_almet' => 'Penerimaan JAS ALMAMATER',
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
            fputcsv($out, $this->netralkanBarisCsv($row));
        }
        fclose($out);
    };

    return response()->stream($callback, 200, [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => "attachment; filename=\"{$namaFile}\"",
    ]);
}

/**
 * Helper bareng buat tugasDetail() & tugasExportExcel() supaya tidak
 * duplikasi query.
 */
protected function siapkanDataTugasDetail($groupId): array
{
    $group = Group::with('mentor')->findOrFail($groupId);

    // Individu, Kelompok, ATK, lalu Jas Almamater -- biar kolomnya gampang dikelompokkan di tampilan.
    $tasks = Task::where('status', '!=', 'draft')
        ->orderByRaw("FIELD(task_type, 'individu', 'kelompok', 'atk', 'jas_almet')")
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

/**
 * Cegah CSV/Formula Injection: kalau suatu nilai (mis. nama mahasiswa, yang
 * diisi bebas oleh user) diawali =, +, -, @, atau tab/CR, Excel/Sheets akan
 * menganggapnya sebagai FORMULA saat file dibuka, bukan teks biasa.
 * Prefix dengan tanda kutip satu (') menetralkannya jadi teks apa adanya.
 */
protected function netralkanBarisCsv(array $row): array
{
    return array_map(function ($v) {
        $s = (string) $v;
        return preg_match('/^[=+\-@\t\r]/', $s) ? "'" . $s : $s;
    }, $row);
}

}