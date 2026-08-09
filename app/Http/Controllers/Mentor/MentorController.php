<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;

class MentorController extends Controller
{
    public function modul()
    {
        return view('role.mentor.modul');
    }

    public function leaderboard()
    {
        return view('role.mentor.leaderboard');
    }

    public function dashboard()
    {
        $jadwalHariIni = \App\Models\Schedule::where('status', 'published')
            ->whereDate('schedule_date', today())
            ->orderBy('schedule_begin_time')
            ->get();

        return view('role.mentor.dashboard', compact('jadwalHariIni'));
    }

    public function info()
    {
        $announcementData = \App\Models\Information::where('status', 'published')
            ->orderByDesc('important_flag')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($i) {
                $meta = [];
                if ($i->important_flag) {
                    $meta[] = ['kind' => 'date', 'text' => $i->created_at->translatedFormat('d F Y')];
                }
                return [
                    'icon' => '📢',
                    'type' => $i->important_flag ? 'urgent' : 'default',
                    'tag' => strtoupper($i->category),
                    'title' => $i->title,
                    'desc' => $i->description ?? '-',
                    'meta' => $meta,
                ];
            });

        return view('role.mentor.info', compact('announcementData'));
    }

    public function profil()
    {
        return view('role.mentor.profil');
    }

    /**
     * Update nomor telepon & foto profil mentor yang sedang login.
     */
    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $validated = $request->validateWithBag('profileUpdate', [
            'phone_no' => ['nullable', 'string', 'max:20'],
            'avatar'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [], [
            'phone_no' => 'nomor telepon',
            'avatar'   => 'foto profil',
        ]);

        $user = $request->user();

        if ($request->hasFile('avatar')) {
            if ($user->profile_picture) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_picture);
            }
            $validated['profile_picture'] = $request->file('avatar')->store('profile-photos', 'public');
        }

        $user->update([
            'phone_no' => $validated['phone_no'] ?? null,
            'profile_picture' => $validated['profile_picture'] ?? $user->profile_picture,
        ]);

        return back()->with('profileStatus', 'Nomor telepon & foto profil berhasil diperbarui.');
    }

    /**
     * Ubah kata sandi akun mentor yang sedang login.
     */
    public function updatePassword(\Illuminate\Http\Request $request)
    {
        $validated = $request->validateWithBag('passwordUpdate', [
            'old_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
        ], [
            'old_password.current_password' => 'Kata sandi lama yang Anda masukkan salah.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak sama.',
            'new_password.different' => 'Kata sandi baru tidak boleh sama dengan kata sandi lama.',
        ]);

        $request->user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($validated['new_password']),
        ]);

        return back()->with('passwordStatus', 'Kata sandi berhasil diubah.');
    }

    public function jadwal()
    {
        $jadwalList = \App\Models\Schedule::where('status', 'published')
            ->orderBy('schedule_date')
            ->orderBy('schedule_begin_time')
            ->get();

        return view('role.mentor.jadwal', compact('jadwalList'));
    }

    /**
     * Halaman Absensi mentor: menampilkan kelompok bimbingannya + semua
     * sesi presensi yang dibuat Panitia, beserta tanda H/I/S/A yang sudah
     * tersimpan (kalau ada).
     */
    /**
     * Mentor UI pakai kode singkat H/I/S/A, tapi data di database (dan
     * laporan Admin di MonitoringController) pakai kata penuh
     * hadir/izin/sakit/alfa — peta ini menjembatani keduanya.
     */
    protected const STATUS_SINGKAT_KE_PENUH = ['H' => 'hadir', 'I' => 'izin', 'S' => 'sakit', 'A' => 'alfa'];
    protected const STATUS_PENUH_KE_SINGKAT = ['hadir' => 'H', 'izin' => 'I', 'sakit' => 'S', 'alfa' => 'A'];

    public function absensi()
    {
        $group = \App\Models\Group::where('mentor_id', auth()->id())->first();

        $students = $group
            ? \App\Models\Member::with('student:id,name')
                ->where('group_id', $group->id)
                ->get()
                ->pluck('student')
                ->filter()
                ->values()
            : collect();

        $templates = \App\Models\AttendanceTemplate::orderBy('attendance_date')->orderBy('time_begin')->get();

        // Attendance (per sesi, untuk kelompok ini) + detail per mahasiswa, dipetakan
        // supaya gampang dipakai di FE: [template_id => ['status' => ..., 'marks' => [student_id => 'H'|'I'|'S'|'A']]]
        $attendanceMap = [];
        if ($group) {
            $attendances = \App\Models\Attendance::with('details')
                ->where('group_id', $group->id)
                ->whereIn('attendance_template_id', $templates->pluck('id'))
                ->get();

            foreach ($attendances as $att) {
                $attendanceMap[$att->attendance_template_id] = [
                    'status' => $att->status,
                    'marks' => $att->details->pluck('status_presence', 'student_id')
                        ->map(fn($v) => self::STATUS_PENUH_KE_SINGKAT[$v] ?? $v),
                ];
            }
        }

        return view('role.mentor.absensi', compact('group', 'students', 'templates', 'attendanceMap'));
    }

    /**
     * Simpan tanda H/I/S/A untuk satu sesi (masih draft, belum dikunci).
     */
    public function absensiSave(\Illuminate\Http\Request $request, \App\Models\AttendanceTemplate $template)
    {
        $group = \App\Models\Group::where('mentor_id', auth()->id())->first();
        abort_unless($group, 403, 'Kamu belum ditugaskan ke kelompok manapun.');

        $validated = $request->validate([
            'marks' => ['required', 'array'],
            'marks.*' => ['required', 'in:H,I,S,A'],
        ]);

        $attendance = \App\Models\Attendance::firstOrNew([
            'group_id' => $group->id,
            'attendance_template_id' => $template->id,
        ]);

        if ($attendance->exists && $attendance->status === 'submitted') {
            return response()->json(['message' => 'Sesi ini sudah disubmit dan tidak bisa diubah lagi.'], 422);
        }

        $attendance->attendance_date = $template->attendance_date;
        $attendance->status = 'draft';
        if (!$attendance->exists) {
            $attendance->created_by_id = auth()->id();
        }
        $attendance->updated_by_id = auth()->id();
        $attendance->save();

        // student_id di 'marks' dikirim sebagai string key JSON -> pastikan integer
        $validStudentIds = \App\Models\Member::where('group_id', $group->id)->pluck('student_id')->all();

        foreach ($validated['marks'] as $studentId => $status) {
            $studentId = (int) $studentId;
            if (!in_array($studentId, $validStudentIds, true)) {
                continue; // abaikan kalau bukan anggota kelompok ini
            }
            \App\Models\AttendanceDetail::updateOrCreate(
                ['attendance_id' => $attendance->id, 'student_id' => $studentId],
                [
                    'status_presence' => self::STATUS_SINGKAT_KE_PENUH[$status] ?? $status,
                    'created_by_id' => auth()->id(),
                    'updated_by_id' => auth()->id(),
                ]
            );
        }

        return response()->json(['message' => 'Presensi berhasil disimpan (draft).']);
    }

    /**
     * Submit (kunci) presensi untuk satu sesi. Setelah ini, tidak ada yang
     * bisa mengubah data sesi tersebut lagi — jadi arsip.
     */
    public function absensiSubmit(\App\Models\AttendanceTemplate $template)
    {
        $group = \App\Models\Group::where('mentor_id', auth()->id())->first();
        abort_unless($group, 403, 'Kamu belum ditugaskan ke kelompok manapun.');

        $attendance = \App\Models\Attendance::where('group_id', $group->id)
            ->where('attendance_template_id', $template->id)
            ->first();

        if (!$attendance) {
            return response()->json(['message' => 'Belum ada presensi yang diisi untuk sesi ini.'], 422);
        }
        if ($attendance->status === 'submitted') {
            return response()->json(['message' => 'Sesi ini sudah disubmit sebelumnya.'], 422);
        }

        $attendance->status = 'submitted';
        $attendance->updated_by_id = auth()->id();
        $attendance->save();

        return response()->json(['message' => 'Presensi berhasil disubmit dan sekarang terkunci.']);
    }

    public function evaluasi()
    {
        $group = \App\Models\Group::where('mentor_id', auth()->id())->first();

        $categories = \App\Models\EvaluationCategory::orderBy('urutan')->get();
        $kategoriEvaluasi = $categories->map(fn($c) => ['id' => (string) $c->id, 'nama' => $c->name]);

        $anggotaKelompok = collect();
        if ($group) {
            $studentIds = \App\Models\Member::where('group_id', $group->id)->pluck('student_id');

            $evaluations = \App\Models\Evaluation::whereIn('student_id', $studentIds)
                ->with('details')
                ->get()
                ->keyBy('student_id');

            $anggotaKelompok = \App\Models\Member::where('group_id', $group->id)
                ->with('student')
                ->get()
                ->map(function ($m) use ($categories, $evaluations) {
                    $evaluation = $evaluations->get($m->student_id);
                    $detailByCategory = $evaluation ? $evaluation->details->keyBy('evaluation_category_id') : collect();

                    $hasil = $categories->mapWithKeys(function ($cat) use ($detailByCategory, $evaluation) {
                        $detail = $detailByCategory->get($cat->id);
                        return [(string) $cat->id => [
                            'selesai' => $detail !== null,
                            'skor' => $detail?->value,
                            'waktu' => $detail ? $evaluation->updated_at?->translatedFormat('d M Y, H:i') : null,
                        ]];
                    });

                    return [
                        'nama' => $m->student->name ?? '-',
                        'npm' => $m->student->npm ?? '-',
                        'hasil' => $hasil,
                    ];
                })->values();
        }

        return view('role.mentor.evaluasi', compact('group', 'kategoriEvaluasi', 'anggotaKelompok'));
    }

    public function evaluasiDetail()
    {
        return view('role.mentor.evaluasi-detail');
    }

    public function keaktifan()
    {
        return view('role.mentor.keaktifan');
    }

    public function monitoringTugas()
    {
        $group = \App\Models\Group::where('mentor_id', auth()->id())->first();

        // Urutkan tugas individu duluan baru kelompok, supaya kolomnya di tabel
        // gampang dikelompokkan per jenis (bukan campur acak).
        $tasks = \App\Models\Task::where('status', '!=', 'draft')
            ->orderByRaw("FIELD(task_type, 'individu', 'kelompok')")
            ->orderBy('deadline')
            ->get();
        $daftarTugas = $tasks->map(fn($t) => ['id' => (string) $t->id, 'nama' => $t->title, 'tipe' => $t->task_type]);

        $anggotaKelompok = collect();
        if ($group) {
            $anggotaKelompok = \App\Models\Member::where('group_id', $group->id)
                ->with('student')
                ->get()
                ->map(function ($m) use ($tasks) {
                    // Status pengumpulan SELALU per mahasiswa, baik tugas individu
                    // maupun kelompok — supaya mentor bisa membedakan anggota yang
                    // benar-benar ikut mengerjakan dari yang tidak, walau tugasnya
                    // ditugaskan ke kelompok.
                    $doneTaskIds = \App\Models\StudentTask::where('student_id', $m->student_id)
                        ->where('status', 'selesai')
                        ->pluck('task_id')
                        ->all();

                    $tugas = $tasks->mapWithKeys(function ($t) use ($doneTaskIds) {
                        return [(string) $t->id => in_array($t->id, $doneTaskIds, true)];
                    });

                    return [
                        'student_id' => $m->student_id,
                        'nama' => $m->student->name ?? '-',
                        'npm' => $m->student->npm ?? '-',
                        'tugas' => $tugas,
                    ];
                })->values();
        }

        return view('role.mentor.monitoring-tugas', compact('group', 'daftarTugas', 'anggotaKelompok'));
    }

    /**
     * Mentor kirim sekaligus semua centang status pengumpulan tugas (per
     * mahasiswa, per tugas) dari halaman Monitoring Pengumpulan Tugas —
     * dikirim satu kali lewat tombol "Kirim", bukan tersimpan otomatis tiap
     * klik centang.
     *
     * Statusnya selalu disimpan per mahasiswa (student_tasks), baik untuk tugas
     * individu maupun kelompok — sengaja TIDAK otomatis menyamakan status ke
     * seluruh anggota kelompok, karena bisa saja ada anggota yang tidak ikut
     * mengerjakan padahal tugasnya ditugaskan ke kelompoknya.
     */
    public function monitoringTugasSubmit(\Illuminate\Http\Request $request)
    {
        $group = \App\Models\Group::where('mentor_id', auth()->id())->first();
        abort_unless($group, 403, 'Kamu belum punya kelompok bimbingan.');

        $validated = $request->validate([
            'data' => 'required|array',
        ]);

        $validStudentIds = \App\Models\Member::where('group_id', $group->id)->pluck('student_id')->all();
        $validTaskIds = \App\Models\Task::where('status', '!=', 'draft')->pluck('id')->all();

        $disimpan = 0;
        foreach ($validated['data'] as $studentId => $tugasMap) {
            $studentId = (int) $studentId;
            if (!in_array($studentId, $validStudentIds, true) || !is_array($tugasMap)) {
                continue; // abaikan kalau bukan anggota kelompok ini
            }

            foreach ($tugasMap as $taskId => $selesai) {
                $taskId = (int) $taskId;
                if (!in_array($taskId, $validTaskIds, true)) {
                    continue; // abaikan kalau task_id-nya tidak valid/tidak aktif
                }

                // PENTING: $selesai datang dari request HTTP sebagai STRING
                // ("true"/"false"), bukan boolean asli — PHP menganggap string
                // "false" itu TRUTHY, jadi harus di-parse eksplisit pakai
                // filter_var(), bukan langsung dipakai di kondisi if/ternary.
                $selesai = filter_var($selesai, FILTER_VALIDATE_BOOLEAN);

                $record = \App\Models\StudentTask::firstOrNew([
                    'student_id' => $studentId,
                    'task_id' => $taskId,
                ]);
                $record->status = $selesai ? 'selesai' : 'ditugaskan';
                if (!$record->exists) {
                    $record->created_by_id = auth()->id();
                }
                $record->updated_by_id = auth()->id();
                $record->save();
                $disimpan++;
            }
        }

        return response()->json([
            'message' => 'Status pengumpulan tugas berhasil dikirim.',
            'disimpan' => $disimpan,
        ]);
    }
}
