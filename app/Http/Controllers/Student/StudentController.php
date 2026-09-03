<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function modul()
    {
        $modulData = \App\Models\ModuleItem::where('status', 'aktif')->orderBy('id')->get();
        return view('role.student.modul', compact('modulData'));
    }

    public function leaderboard()
    {
        $dataMahasiswa = \App\Support\Leaderboard::hitungRanking();
        $currentStudentId = auth()->id();
        return view('role.student.leaderboard', compact('dataMahasiswa', 'currentStudentId'));
    }

    public function dashboard()
    {
        $jadwalHariIni = \App\Models\Schedule::where('status', 'published')
            ->whereDate('schedule_date', today())
            ->orderBy('schedule_begin_time')->get();
        $progres = $this->hitungProgresMahasiswa(auth()->id());
        return view('role.student.dashboard', compact('jadwalHariIni', 'progres'));
    }

    protected function hitungProgresMahasiswa(int $studentId): int
    {
        $groupId = \App\Models\Member::where('student_id', $studentId)->value('group_id');

        $persenAbsensi = null;
        if ($groupId) {
            $templateIdsLewat = \App\Models\AttendanceTemplate::where('attendance_date', '<=', today())->pluck('id');
            $totalSesi = $templateIdsLewat->count();
            if ($totalSesi > 0) {
                $attendanceIdsSubmitted = \App\Models\Attendance::where('group_id', $groupId)
                    ->whereIn('attendance_template_id', $templateIdsLewat)
                    ->where('status', 'submitted')->pluck('id');
                $hadir = \App\Models\AttendanceDetail::where('student_id', $studentId)
                    ->whereIn('attendance_id', $attendanceIdsSubmitted)
                    ->where('status_presence', 'hadir')->count();
                $persenAbsensi = $hadir / $totalSesi * 100;
            }
        }

        $persenEvaluasi = null;
        $totalEvaluasi = \App\Models\Exam::count();
        if ($totalEvaluasi > 0) {
            $evaluasiDikerjakan = \App\Models\ExamAttemptScore::query()
                ->join('exam_attempts', function ($join) {
                    $join->on('exam_attempt_scores.exam_id', '=', 'exam_attempts.exam_id')
                        ->on('exam_attempt_scores.student_id', '=', 'exam_attempts.student_id')
                        ->on('exam_attempt_scores.cycle', '=', 'exam_attempts.cycle');
                })
                ->where('exam_attempt_scores.student_id', $studentId)
                ->distinct('exam_attempt_scores.exam_id')
                ->count('exam_attempt_scores.exam_id');
            $persenEvaluasi = $evaluasiDikerjakan / $totalEvaluasi * 100;
        }

        $persenTugas = null;
        $individuTaskIds = \App\Models\StudentTask::where('student_id', $studentId)->pluck('task_id');
        $groupTaskIds = $groupId ? \App\Models\GroupTask::where('group_id', $groupId)->pluck('task_id') : collect();
        $totalTugasIds = $individuTaskIds->merge($groupTaskIds)->unique();
        if ($totalTugasIds->count() > 0) {
            $tugasSelesai = \App\Models\StudentTask::where('student_id', $studentId)
                ->where('status', 'selesai')->whereIn('task_id', $totalTugasIds)->count();
            $persenTugas = $tugasSelesai / $totalTugasIds->count() * 100;
        }

        $komponen = array_filter([$persenAbsensi, $persenEvaluasi, $persenTugas], fn($v) => $v !== null);
        return count($komponen) > 0 ? (int) round(array_sum($komponen) / count($komponen)) : 0;
    }

    public function info()
    {
        $announcementData = \App\Models\Information::where('status', 'published')
            ->orderByDesc('important_flag')->orderByDesc('created_at')->get()
            ->map(function ($i) {
                $meta = [];
                if ($i->important_flag) $meta[] = ['kind' => 'date', 'text' => $i->created_at->translatedFormat('d F Y')];
                return [
                    'icon' => '📢', 'type' => $i->important_flag ? 'urgent' : 'default',
                    'tag' => strtoupper($i->category), 'title' => $i->title,
                    'desc' => $i->description ?? '-', 'meta' => $meta,
                ];
            });
        return view('role.student.info', compact('announcementData'));
    }

    public function profil()
    {
        return view('role.student.profil');
    }

    public function jadwal()
    {
        $jadwalList = \App\Models\Schedule::where('status', 'published')
            ->orderBy('schedule_date')->orderBy('schedule_begin_time')->get();
        return view('role.student.jadwal', compact('jadwalList'));
    }

    public function keaktifan()
    {
        $user = auth()->user();
        $member = \App\Models\Member::where('student_id', $user->id)->with('group')->first();
        $riwayatPoin = \App\Models\Activity::where('student_id', $user->id)->orderByDesc('created_at')->get()
            ->map(fn ($a) => [
                'tipe' => $a->activity_value >= 0 ? 'keaktifan' : 'pelanggaran',
                'judul' => $a->description ?: $a->category,
                'poin' => abs((int) $a->activity_value),
                'tanggal' => $a->created_at?->translatedFormat('d M Y'),
            ])->values();

        return view('role.student.keaktifan', [
            'identitas' => [
                'nama' => $user->name, 'npm' => $user->npm,
                'kelompok' => $member?->group?->name ?? '-',
            ],
            'riwayatPoin' => $riwayatPoin,
        ]);
    }

    public function materi()
    {
        $topics = \App\Models\Topic::where('status', 'published')->orderByDesc('created_at')->get();
        $progressMap = \App\Models\TopicProgress::where('student_id', auth()->id())->pluck('percent', 'topic_id');
        $gradients = [
            'from-teal-600 to-blue-800', 'from-purple-600 to-indigo-800', 'from-amber-500 to-orange-700',
            'from-cyan-600 to-blue-800', 'from-purple-600 to-pink-700', 'from-indigo-600 to-purple-800',
        ];

        $mapItem = function ($t, $idx) use ($gradients, $progressMap) {
            return [
                'id' => ($t->category === 'video' ? 'vid-' : 'doc-') . $t->id,
                'topicId' => $t->id, 'tipe' => $t->category, 'judul' => $t->title,
                'deskripsi' => '-', 'pemateri' => $t->trainer ?? '-', 'durasi' => '-',
                'youtube' => $t->category === 'video' ? ($t->file_link ?? '#') : null,
                'pdf' => $t->category === 'ebook' ? ($t->file_link ?? '#') : null,
                'fileSize' => '-', 'updatedAt' => $t->updated_at?->translatedFormat('d F Y'),
                'thumbnailImg' => $t->thumbnail_link ?? '',
                'gradientFallback' => $gradients[$idx % count($gradients)],
                'progress' => $t->category === 'video' ? (int) ($progressMap[$t->id] ?? 0) : 0,
                'downloadUrl' => $t->download_link ?: null,
                'tags' => array_values(array_filter([$t->category, $t->topic_type])),
            ];
        };

        $videoMateri = $topics->where('category', 'video')->values()->map(fn($t, $i) => $mapItem($t, $i));
        $ebookMateri = $topics->where('category', 'ebook')->values()->map(fn($t, $i) => $mapItem($t, $i));
        return view('role.student.materi', compact('videoMateri', 'ebookMateri'));
    }

    public function materiProgress(\Illuminate\Http\Request $request, \App\Models\Topic $topic)
    {
        $percent = max(0, min(100, (int) $request->input('percent', 0)));
        $row = \App\Models\TopicProgress::firstOrNew([
            'student_id' => auth()->id(), 'topic_id' => $topic->id,
        ]);
        $row->percent = max($row->percent ?? 0, $percent);
        $row->save();
        return response()->json(['percent' => $row->percent]);
    }

    public function denahKampus()
    {
        return view('role.student.denah-kampus');
    }

    public function evaluasi()
    {
        $exams = \App\Models\Exam::with('details')->orderBy('title')->get();

        $skorAttemptSaya = \App\Models\ExamAttemptScore::query()
            ->join('exam_attempts', function ($join) {
                $join->on('exam_attempt_scores.exam_id', '=', 'exam_attempts.exam_id')
                    ->on('exam_attempt_scores.student_id', '=', 'exam_attempts.student_id')
                    ->on('exam_attempt_scores.cycle', '=', 'exam_attempts.cycle');
            })
            ->where('exam_attempt_scores.student_id', auth()->id())
            ->whereIn('exam_attempt_scores.exam_id', $exams->pluck('id'))
            ->select('exam_attempt_scores.*')->get()
            ->groupBy('exam_id')->map(fn ($grup) => $grup->pluck('skor'));

        $attemptMap = \App\Models\ExamAttempt::where('student_id', auth()->id())
            ->whereIn('exam_id', $exams->pluck('id'))->get()->keyBy('exam_id');

        $riwayatAttemptSaya = \App\Models\ExamAttemptScore::where('student_id', auth()->id())
            ->whereIn('exam_id', $exams->pluck('id'))
            ->orderBy('cycle')->orderBy('attempt_number')->get()
            ->groupBy(['exam_id', 'cycle']);

        $hurufKeIndex = ['a' => 0, 'b' => 1, 'c' => 2, 'd' => 3];
        $warnaPalet = [
            'linear-gradient(135deg,#f59e0b,#c2410c)', 'linear-gradient(135deg,#0d9488,#1e40af)',
            'linear-gradient(135deg,#9333ea,#3730a3)', 'linear-gradient(135deg,#dc2626,#7c2d12)',
            'linear-gradient(135deg,#2563eb,#1e3a8f)', 'linear-gradient(135deg,#16a34a,#14532d)',
        ];

        $daftarKuis = $exams->values()->map(function ($exam, $idx) use (
            $hurufKeIndex, $warnaPalet, $attemptMap, $skorAttemptSaya, $riwayatAttemptSaya
        ) {
            $attempt = $attemptMap->get($exam->id);
            $skorList = $skorAttemptSaya->get($exam->id, collect());
            $rataRata = \App\Support\ExamScoring::rataRata($skorList);
            $lulus = $rataRata !== null && $rataRata >= (int) $exam->passing_grade;

            $riwayatSiklus = $riwayatAttemptSaya->get($exam->id, collect())->map(function ($scores, $cycle) {
                $scores = $scores->sortBy('attempt_number')->values();
                return [
                    'cycle' => (int) $cycle,
                    'skor' => $scores->map(fn ($s) => [
                        'attempt' => (int) $s->attempt_number,
                        'skor' => (int) $s->skor,
                    ])->values()->all(),
                    'rataRata' => \App\Support\ExamScoring::rataRata($scores->pluck('skor')),
                ];
            })->values()->all();

            return [
                'id' => (string) $exam->id, 'judul' => $exam->title,
                'deskripsi' => $exam->subtitle ?? '-', 'warna' => $warnaPalet[$idx % count($warnaPalet)],
                'passingGrade' => (int) $exam->passing_grade,
                'attemptsUsed' => (int) ($attempt->attempts ?? 0),
                'cycle' => (int) ($attempt->cycle ?? 1),
                'skorRataRata' => $rataRata, 'lulus' => $lulus,
                'dapatKirimEvaluasi' => $lulus, 'riwayatSiklus' => $riwayatSiklus,
                'soal' => $exam->details->map(function ($d) use ($hurufKeIndex) {
                    $options = array_values(array_filter(
                        [$d->option_a, $d->option_b, $d->option_c, $d->option_d],
                        fn($o) => $o !== null && $o !== ''
                    ));
                    return [
                        'question' => $d->question, 'options' => $options,
                        'correctAnswer' => $hurufKeIndex[strtolower($d->key)] ?? 0,
                    ];
                })->values(),
            ];
        })->filter(fn($k) => count($k['soal']) > 0)->values();

        $statusAwal = [];
        foreach ($exams as $exam) {
            $skorList = $skorAttemptSaya->get($exam->id);
            if (\App\Support\ExamScoring::sudahDikerjakan($skorList)) {
                $rataRata = \App\Support\ExamScoring::rataRata($skorList);
                $statusAwal[(string) $exam->id] = [
                    'skorRataRata' => $rataRata, 'skorTerbaik' => $rataRata,
                    'passingGrade' => (int) $exam->passing_grade,
                    'lulus' => $rataRata >= (int) $exam->passing_grade,
                    'sudahKirim' => true,
                ];
            }
        }

        return view('role.student.evaluasi', compact('daftarKuis', 'statusAwal'));
    }

    public function evaluasiMulaiAttempt(\Illuminate\Http\Request $request, \App\Models\Exam $exam)
    {
        $maxAttempts = 3;

        $attempt = \App\Models\ExamAttempt::firstOrCreate(
            ['exam_id' => $exam->id, 'student_id' => auth()->id()],
            ['attempts' => 0, 'cycle' => 1]
        );

        $skorList = \App\Models\ExamAttemptScore::where('exam_id', $exam->id)
            ->where('student_id', auth()->id())->where('cycle', $attempt->cycle)->pluck('skor');
        $rataRata = \App\Support\ExamScoring::rataRata($skorList);

        if ($rataRata !== null && $rataRata >= (int) $exam->passing_grade) {
            return response()->json([
                'message' => 'Anda sudah lulus evaluasi ini dan tidak perlu mengulang.',
                'attemptsUsed' => $attempt->attempts, 'maxAttempts' => $maxAttempts,
                'passingGrade' => (int) $exam->passing_grade, 'skorRataRata' => $rataRata,
                'allowed' => false, 'passed' => true,
            ], 422);
        }

        if ($attempt->attempts >= $maxAttempts) {
            return response()->json([
                'message' => "Siklus percobaan sudah mencapai {$maxAttempts}x. Silakan lihat hasil atau mulai siklus berikutnya.",
                'attemptsUsed' => $attempt->attempts, 'maxAttempts' => $maxAttempts,
                'allowed' => false, 'passed' => false,
            ], 422);
        }

        $attempt->increment('attempts');
        $attempt->refresh();

        return response()->json([
            'attemptsUsed' => $attempt->attempts, 'maxAttempts' => $maxAttempts,
            'cycle' => $attempt->cycle, 'allowed' => true, 'passed' => false,
        ]);
    }

    public function evaluasiSubmit(\Illuminate\Http\Request $request, \App\Models\Exam $exam)
    {
        $maxAttempts = 3;

        $validated = $request->validate([
            'jawaban' => ['required', 'array'],
            'jawaban.*' => ['nullable', 'integer', 'min:0', 'max:5'],
        ]);

        $attempt = \App\Models\ExamAttempt::where('exam_id', $exam->id)
            ->where('student_id', auth()->id())->first();

        if (!$attempt || $attempt->attempts < 1 || $attempt->attempts > $maxAttempts) {
            return response()->json([
                'message' => 'Percobaan tidak valid. Silakan mulai evaluasi kembali.',
                'allowed' => false,
            ], 422);
        }

        $cycle = (int) ($attempt->cycle ?: 1);
        $attemptSaatIni = (int) $attempt->attempts;

        $rataSebelumnya = \App\Support\ExamScoring::rataRata(
            \App\Models\ExamAttemptScore::where('exam_id', $exam->id)
                ->where('student_id', auth()->id())->where('cycle', $cycle)->pluck('skor')
        );

        if ($rataSebelumnya !== null && $rataSebelumnya >= (int) $exam->passing_grade) {
            return response()->json([
                'message' => 'Evaluasi ini sudah lulus.',
                'skorRataRata' => $rataSebelumnya, 'passingGrade' => (int) $exam->passing_grade,
                'lulus' => true, 'dapatKirimEvaluasi' => true,
            ], 422);
        }

        $details = $exam->details()->orderBy('id')->get();
        $hurufAbjad = ['a', 'b', 'c', 'd', 'e', 'f'];
        $benar = 0;

        foreach ($details as $i => $detail) {
            $pilihIndex = $validated['jawaban'][$i] ?? null;
            $pilihHuruf = $pilihIndex !== null ? ($hurufAbjad[$pilihIndex] ?? null) : null;

            \App\Models\StudentExam::updateOrCreate(
                ['exam_id' => $exam->id, 'exam_detail_id' => $detail->id, 'student_id' => auth()->id()],
                [
                    'question' => $detail->question, 'value' => $pilihHuruf,
                    'created_by_id' => auth()->id(), 'updated_by_id' => auth()->id(),
                ]
            );

            if ($pilihHuruf && strtolower($pilihHuruf) === strtolower($detail->key)) $benar++;
        }

        $skor = $details->count() ? (int) round($benar / $details->count() * 100) : 0;

        \App\Models\ExamAttemptScore::updateOrCreate(
            [
                'exam_id' => $exam->id, 'student_id' => auth()->id(),
                'cycle' => $cycle, 'attempt_number' => $attemptSaatIni,
            ],
            ['skor' => $skor]
        );

        $skorRataRata = \App\Support\ExamScoring::rataRata(
            \App\Models\ExamAttemptScore::where('exam_id', $exam->id)
                ->where('student_id', auth()->id())->where('cycle', $cycle)->pluck('skor')
        );

        $passingGrade = (int) $exam->passing_grade;
        $lulus = $skorRataRata !== null && $skorRataRata >= $passingGrade;
        $resetDilakukan = false;

        if (!$lulus && $attemptSaatIni >= $maxAttempts) {
            $attempt->update(['attempts' => 0, 'cycle' => $cycle + 1]);
            $resetDilakukan = true;
        }

        $riwayatSiklusAktif = \App\Models\ExamAttemptScore::where('exam_id', $exam->id)
            ->where('student_id', auth()->id())->where('cycle', $cycle)
            ->orderBy('attempt_number')->get()
            ->map(fn ($s) => [
                'attempt' => (int) $s->attempt_number, 'skor' => (int) $s->skor,
            ])->values()->all();

        return response()->json([
            'message' => $lulus
                ? 'Hasil kuis berhasil dikirim. Anda lulus evaluasi.'
                : ($resetDilakukan
                    ? 'Nilai rata-rata belum mencapai standar. Percobaan telah di-reset ke Percobaan 1 dan Anda dapat mengulang kembali.'
                    : 'Hasil kuis berhasil dikirim. Nilai belum mencapai standar kelulusan.'),
            'skor' => $skor, 'skorRataRata' => $skorRataRata,
            'passingGrade' => $passingGrade, 'lulus' => $lulus,
            'dapatKirimEvaluasi' => $lulus,
            'attemptsUsed' => $resetDilakukan ? 0 : $attemptSaatIni,
            'maxAttempts' => $maxAttempts,
            'cycle' => $resetDilakukan ? $cycle + 1 : $cycle,
            'resetDilakukan' => $resetDilakukan,
            'cycleSelesai' => $cycle,
            'riwayatSiklus' => $riwayatSiklusAktif,
        ]);
    }

    public function absensi()
    {
        $member = \App\Models\Member::with('group')->where('student_id', auth()->id())->first();
        $groupName = $member?->group?->name;
        $tandaPerTanggal = [];

        if ($member) {
            $attendances = \App\Models\Attendance::with('template')->where('group_id', $member->group_id)->get();
            $labelStatus = ['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alfa' => 'Alpha'];

            foreach ($attendances as $att) {
                $detail = \App\Models\AttendanceDetail::where('attendance_id', $att->id)
                    ->where('student_id', auth()->id())->first();
                $tanggal = $att->attendance_date;
                $tandaPerTanggal[$tanggal] = $tandaPerTanggal[$tanggal] ?? [];
                $tandaPerTanggal[$tanggal][] = [
                    'label' => $att->template->session_name ?? '-',
                    'waktu' => substr($att->template->time_begin ?? '00:00', 0, 5) . ' WIB',
                    'status' => $detail ? ($labelStatus[$detail->status_presence] ?? 'Belum Mulai') : 'Belum Mulai',
                ];
            }

            foreach ($tandaPerTanggal as $tgl => $sesiList) {
                usort($sesiList, fn($a, $b) => strcmp($a['waktu'], $b['waktu']));
                $tandaPerTanggal[$tgl] = $sesiList;
            }
        }

        return view('role.student.absensi', compact('groupName', 'tandaPerTanggal'));
    }

    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $validated = $request->validateWithBag('profileUpdate', [
            'phone_no' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [], ['phone_no' => 'nomor telepon', 'avatar' => 'foto profil']);

        $user = $request->user();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('profile-photos', 'public');
            if ($path === false) {
                return back()->withErrors(['avatar' => 'Gagal menyimpan foto. Coba lagi.'], 'profileUpdate')->withInput();
            }

            if ($user->profile_picture) \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_picture);
            $validated['profile_picture'] = $path;
        }

        $user->update([
            'phone_no' => $validated['phone_no'] ?? null,
            'profile_picture' => $validated['profile_picture'] ?? $user->profile_picture,
        ]);

        return back()->with('profileStatus', 'Nomor telepon & foto profil berhasil diperbarui.');
    }

    public function updatePassword(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
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

        return response()->json(['message' => 'Kata sandi berhasil diubah.']);
    }
}
