<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function modul()
    {
        // "Kelola Modul PKKMB" (Panitia) satu-satunya sumber konten halaman
        // ini -- gak ada lagi teks bawaan/hardcode, murni tampilkan section
        // yang statusnya "aktif" (published), diurutkan sesuai dibuatnya.
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
        $hariIni = \Carbon\Carbon::now('Asia/Jakarta')->toDateString();

        $jadwalHariIni = \App\Models\Schedule::where('status', 'published')
            ->whereDate('schedule_date', $hariIni)
            ->orderBy('schedule_begin_time')
            ->limit(3)
            ->get();
        // Carousel "Informasi Terbaru" di dashboard -- maksimal 5, murni
        // terbaru dulu (BUKAN important_flag dulu seperti di info()), jadi
        // begitu ada info baru, item ke-6 otomatis ke-cut dari carousel ini
        // (tapi tetap tampil lengkap di halaman Info lewat method info()).
        $informasiTerbaru = \App\Models\Information::where('status', 'published')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        $progres = $this->hitungProgresMahasiswa(auth()->id());

        return view('role.student.dashboard', compact('jadwalHariIni', 'informasiTerbaru', 'progres'));
    }

    /**
     * Progres PKKMB-KT mahasiswa = rata-rata dari 3 komponen (kalau datanya
     * ada): % kehadiran (dari sesi yang sudah lewat), % paket evaluasi yang
     * sudah dikerjakan minimal 1x, dan % tugas yang sudah diselesaikan (dari
     * tugas individu + tugas kelompok yang ditugaskan ke dia). Komponen yang
     * penyebutnya masih 0 (belum ada data sama sekali) dilewati, bukan
     * dianggap 0%, biar gak menyesatkan sebelum kegiatan benar-benar mulai.
     */
    protected function hitungProgresMahasiswa(int $studentId): int
    {
        $groupId = \App\Models\Member::where('student_id', $studentId)->value('group_id');

        // 1) Absensi -- dari sesi (AttendanceTemplate) yang tanggalnya sudah
        // lewat/hari ini, dibandingkan sesi yang statusnya "hadir" pada
        // Attendance kelompoknya yang SUDAH disubmit mentor.
        $persenAbsensi = null;
        if ($groupId) {
            $templateIdsLewat = \App\Models\AttendanceTemplate::where('attendance_date', '<=', today())->pluck('id');
            $totalSesi = $templateIdsLewat->count();
            if ($totalSesi > 0) {
                $attendanceIdsSubmitted = \App\Models\Attendance::where('group_id', $groupId)
                    ->whereIn('attendance_template_id', $templateIdsLewat)
                    ->where('status', 'submitted')
                    ->pluck('id');
                $hadir = \App\Models\AttendanceDetail::where('student_id', $studentId)
                    ->whereIn('attendance_id', $attendanceIdsSubmitted)
                    ->where('status_presence', 'hadir')
                    ->count();
                $persenAbsensi = $hadir / $totalSesi * 100;
            }
        }

        // 2) Evaluasi -- paket yang sudah dikerjakan minimal 1x (ada baris di
        // exam_attempt_scores), dibanding total paket evaluasi yang ada.
        $persenEvaluasi = null;
        $totalEvaluasi = \App\Models\Exam::count();
        if ($totalEvaluasi > 0) {
            $evaluasiDikerjakan = \App\Models\ExamAttemptScore::where('student_id', $studentId)
                ->distinct('exam_id')->count('exam_id');
            $persenEvaluasi = $evaluasiDikerjakan / $totalEvaluasi * 100;
        }

        // 3) Tugas -- gabungan tugas individu (StudentTask) & tugas kelompok
        // (GroupTask, lewat kelompoknya) yang ditugaskan ke dia, dibanding
        // yang sudah ditandai "selesai" oleh mentor.
        $persenTugas = null;
        $individuTaskIds = \App\Models\StudentTask::where('student_id', $studentId)->pluck('task_id');
        $groupTaskIds = $groupId ? \App\Models\GroupTask::where('group_id', $groupId)->pluck('task_id') : collect();
        $totalTugasIds = $individuTaskIds->merge($groupTaskIds)->unique();
        if ($totalTugasIds->count() > 0) {
            $tugasSelesai = \App\Models\StudentTask::where('student_id', $studentId)
                ->where('status', 'selesai')
                ->whereIn('task_id', $totalTugasIds)
                ->count();
            $persenTugas = $tugasSelesai / $totalTugasIds->count() * 100;
        }

        $komponen = array_filter([$persenAbsensi, $persenEvaluasi, $persenTugas], fn($v) => $v !== null);

        return count($komponen) > 0 ? (int) round(array_sum($komponen) / count($komponen)) : 0;
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

        return view('role.student.info', compact('announcementData'));
    }

    public function profil()
    {
        return view('role.student.profil');
    }

    public function jadwal()
    {
        $jadwalList = \App\Models\Schedule::where('status', 'published')
            ->orderBy('schedule_date')
            ->orderBy('schedule_begin_time')
            ->get();

        return view('role.student.jadwal', compact('jadwalList'));
    }

    public function keaktifan()
    {
        $user = auth()->user();
        $member = \App\Models\Member::where('student_id', $user->id)->with('group')->first();

        $riwayatPoin = \App\Models\Activity::where('student_id', $user->id)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn($a) => [
                'tipe' => $a->activity_value >= 0 ? 'keaktifan' : 'pelanggaran',
                'judul' => $a->description ?: $a->category,
                'poin' => abs((int) $a->activity_value),
                'tanggal' => $a->created_at?->translatedFormat('d M Y'),
            ])
            ->values();

        return view('role.student.keaktifan', [
            'identitas' => [
                'nama' => $user->name,
                'npm' => $user->npm,
                'kelompok' => $member?->group?->name ?? '-',
            ],
            'riwayatPoin' => $riwayatPoin,
        ]);
    }

    public function materi()
    {
        $topics = \App\Models\Topic::where('status', 'published')->orderByDesc('created_at')->get();

        // Progres tonton video yang beneran tersimpan buat mahasiswa ini
        // (diisi dari YouTube IFrame Player API, lihat materiProgress()).
        $progressMap = \App\Models\TopicProgress::where('student_id', auth()->id())
            ->pluck('percent', 'topic_id');

        $gradients = [
            'from-teal-600 to-blue-800',
            'from-purple-600 to-indigo-800',
            'from-amber-500 to-orange-700',
            'from-cyan-600 to-blue-800',
            'from-purple-600 to-pink-700',
            'from-indigo-600 to-purple-800',
        ];

        $mapItem = function ($t, $idx) use ($gradients, $progressMap) {
            return [
                'id' => ($t->category === 'video' ? 'vid-' : 'doc-') . $t->id,
                'topicId' => $t->id,
                'tipe' => $t->category,
                'judul' => $t->title,
                'deskripsi' => '-',
                'pemateri' => $t->trainer ?? '-',
                'durasi' => '-',
                'youtube' => $t->category === 'video' ? ($t->file_link ?? '#') : null,
                'pdf' => $t->category === 'ebook' ? ($t->file_link ?? '#') : null,
                'fileSize' => '-',
                'updatedAt' => $t->updated_at?->translatedFormat('d F Y'),
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

    /**
     * Dipanggil dari YouTube IFrame Player API di halaman Materi buat nyimpen
     * progres tonton (persen 0-100). Cuma boleh naik -- kalau mahasiswa
     * nonton ulang dari awal, progres tersimpan gak turun.
     */
    public function materiProgress(\Illuminate\Http\Request $request, \App\Models\Topic $topic)
    {
        $percent = max(0, min(100, (int) $request->input('percent', 0)));

        $row = \App\Models\TopicProgress::firstOrNew([
            'student_id' => auth()->id(),
            'topic_id' => $topic->id,
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

        // Skor RATA-RATA semua percobaan yang sudah diselesaikan (bukan lagi
        // ngitung ulang dari jawaban mentah percobaan terakhir).
        $skorAttemptSaya = \App\Models\ExamAttemptScore::where('student_id', auth()->id())
            ->whereIn('exam_id', $exams->pluck('id'))
            ->get()
            ->groupBy('exam_id')
            ->map(fn($grup) => $grup->pluck('skor'));

        // Berapa kali mahasiswa ini udah "Mulai/Ulangi Kuis" per paket evaluasi
        // -- dipakai buat batasin maksimal 3x percobaan (lihat evaluasiMulaiAttempt()).
        $attemptMap = \App\Models\ExamAttempt::where('student_id', auth()->id())
            ->whereIn('exam_id', $exams->pluck('id'))
            ->get()
            ->keyBy('exam_id');

        $hurufKeIndex = ['a' => 0, 'b' => 1, 'c' => 2, 'd' => 3];
        $warnaPalet = [
            'linear-gradient(135deg,#f59e0b,#c2410c)',
            'linear-gradient(135deg,#0d9488,#1e40af)',
            'linear-gradient(135deg,#9333ea,#3730a3)',
            'linear-gradient(135deg,#dc2626,#7c2d12)',
            'linear-gradient(135deg,#2563eb,#1e3a8f)',
            'linear-gradient(135deg,#16a34a,#14532d)',
        ];

        $daftarKuis = $exams->values()->map(function ($exam, $idx) use ($hurufKeIndex, $warnaPalet, $attemptMap) {
            return [
                'id' => (string) $exam->id,
                'judul' => $exam->title,
                'deskripsi' => $exam->subtitle ?? '-',
                'warna' => $warnaPalet[$idx % count($warnaPalet)],
                'passingGrade' => (int) $exam->passing_grade,
                'attemptsUsed' => (int) ($attemptMap->get($exam->id)->attempts ?? 0),
                'soal' => $exam->details->map(function ($d) use ($hurufKeIndex) {
                    $options = array_values(array_filter([$d->option_a, $d->option_b, $d->option_c, $d->option_d], fn($o) => $o !== null && $o !== ''));
                    return [
                        'question' => $d->question,
                        'options' => $options,
                        'correctAnswer' => $hurufKeIndex[strtolower($d->key)] ?? 0,
                    ];
                })->values(),
            ];
        })->filter(fn($k) => count($k['soal']) > 0)->values();

        // status pengerjaan siswa yang SUDAH tersimpan sebelumnya (kalau ada)
        $statusAwal = [];
        foreach ($exams as $exam) {
            $skorList = $skorAttemptSaya->get($exam->id);
            if (\App\Support\ExamScoring::sudahDikerjakan($skorList)) {
                $statusAwal[(string) $exam->id] = [
                    'skorTerbaik' => \App\Support\ExamScoring::rataRata($skorList),
                    'sudahKirim' => true,
                ];
            }
        }

        return view('role.student.evaluasi', compact('daftarKuis', 'statusAwal'));
    }

    /**
     * Dipanggil tiap kali mahasiswa klik "Mulai Kuis" ATAU "Ulangi Kuis" --
     * naikkan hitungan percobaan dan tolak kalau udah kepake 3x. Sengaja
     * dicatat di server (bukan cuma JS) supaya gak bisa diakalin dengan
     * refresh halaman.
     */
    public function evaluasiMulaiAttempt(\Illuminate\Http\Request $request, \App\Models\Exam $exam)
    {
        $maxAttempts = 3;

        $attempt = \App\Models\ExamAttempt::firstOrCreate(
            ['exam_id' => $exam->id, 'student_id' => auth()->id()],
            ['attempts' => 0]
        );

        if ($attempt->attempts >= $maxAttempts) {
            return response()->json([
                'message' => "Sudah mencapai batas maksimal {$maxAttempts}x percobaan untuk kuis ini.",
                'attemptsUsed' => $attempt->attempts,
                'maxAttempts' => $maxAttempts,
                'allowed' => false,
            ], 422);
        }

        $attempt->increment('attempts');

        return response()->json([
            'attemptsUsed' => $attempt->attempts,
            'maxAttempts' => $maxAttempts,
            'allowed' => true,
        ]);
    }

    /**
     * Simpan hasil satu kuis (dihitung ulang di server, tidak percaya skor
     * dari client) — dipanggil begitu mahasiswa klik "Kirim Hasil".
     */
    public function evaluasiSubmit(\Illuminate\Http\Request $request, \App\Models\Exam $exam)
    {
        $validated = $request->validate([
            'jawaban' => ['required', 'array'],
            'jawaban.*' => ['nullable', 'integer', 'min:0', 'max:5'],
        ]);

        $details = $exam->details()->orderBy('id')->get();
        $hurufAbjad = ['a', 'b', 'c', 'd', 'e', 'f'];
        $benar = 0;

        foreach ($details as $i => $detail) {
            $pilihIndex = $validated['jawaban'][$i] ?? null;
            $pilihHuruf = $pilihIndex !== null ? ($hurufAbjad[$pilihIndex] ?? null) : null;

            \App\Models\StudentExam::updateOrCreate(
                ['exam_id' => $exam->id, 'exam_detail_id' => $detail->id, 'student_id' => auth()->id()],
                [
                    'question' => $detail->question,
                    'value' => $pilihHuruf,
                    'created_by_id' => auth()->id(),
                    'updated_by_id' => auth()->id(),
                ]
            );

            if ($pilihHuruf && strtolower($pilihHuruf) === strtolower($detail->key)) {
                $benar++;
            }
        }

        $skor = $details->count() ? (int) round($benar / $details->count() * 100) : 0;

        // Simpan skor PERCOBAAN INI SAJA (bukan ketimpa) -- attempt_number
        // diambil dari counter exam_attempts yang sudah ke-increment duluan
        // pas mahasiswa klik "Mulai" (evaluasiMulaiAttempt). updateOrCreate
        // biar aman kalau submit-nya kepencet 2x / retry jaringan buat
        // attempt yang sama, gak dobel baris.
        $attemptSaatIni = \App\Models\ExamAttempt::where('exam_id', $exam->id)
            ->where('student_id', auth()->id())
            ->value('attempts') ?? 1;

        \App\Models\ExamAttemptScore::updateOrCreate(
            ['exam_id' => $exam->id, 'student_id' => auth()->id(), 'attempt_number' => $attemptSaatIni],
            ['skor' => $skor]
        );

        // Skor RATA-RATA dari semua percobaan yang sudah diselesaikan -- ini
        // yang beneran dikirim ke Leaderboard & Monitoring/Laporan, BUKAN
        // skor percobaan ini doang.
        $skorRataRata = \App\Support\ExamScoring::rataRata(
            \App\Models\ExamAttemptScore::where('exam_id', $exam->id)->where('student_id', auth()->id())->pluck('skor')
        );

        return response()->json([
            'message' => 'Hasil kuis berhasil dikirim.',
            'skor' => $skor,
            'skorRataRata' => $skorRataRata,
        ]);
    }

    public function absensi()
    {
        $member = \App\Models\Member::with('group')->where('student_id', auth()->id())->first();
        $groupName = $member?->group?->name;

        // semua tanda kehadiran milik mahasiswa ini, dikelompokkan per tanggal —
        // dipakai buat date-picker di halaman (bisa lihat tanggal manapun, bukan cuma hari ini)
        $tandaPerTanggal = [];
        if ($member) {
            $attendances = \App\Models\Attendance::with('template')
                ->where('group_id', $member->group_id)
                ->get();

            $labelStatus = ['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alfa' => 'Alpha'];

            foreach ($attendances as $att) {
                $detail = \App\Models\AttendanceDetail::where('attendance_id', $att->id)
                    ->where('student_id', auth()->id())
                    ->first();

                $tanggal = $att->attendance_date;
                $tandaPerTanggal[$tanggal] = $tandaPerTanggal[$tanggal] ?? [];
                $tandaPerTanggal[$tanggal][] = [
                    'label' => $att->template->session_name ?? '-',
                    'waktu' => substr($att->template->time_begin ?? '00:00', 0, 5) . ' WIB',
                    'status' => $detail ? ($labelStatus[$detail->status_presence] ?? 'Belum Mulai') : 'Belum Mulai',
                ];
            }

            // urutkan sesi tiap tanggal berdasarkan jam mulai
            foreach ($tandaPerTanggal as $tgl => $sesiList) {
                usort($sesiList, fn($a, $b) => strcmp($a['waktu'], $b['waktu']));
                $tandaPerTanggal[$tgl] = $sesiList;
            }
        }

        return view('role.student.absensi', compact('groupName', 'tandaPerTanggal'));
    }

    /**
     * Update nomor telepon & foto profil (satu-satunya data yang boleh
     * diubah sendiri oleh mahasiswa di halaman profil).
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
            $path = $request->file('avatar')->store('profile-photos', 'public');

            // store() balikin `false` (bukan exception) kalau gagal nulis
            // file -- jangan lanjut simpan path yang gagal itu ke database,
            // dan kasih tau user daripada diem aja kayak berhasil.
            if ($path === false) {
                return back()->withErrors(['avatar' => 'Gagal menyimpan foto. Coba lagi.'], 'profileUpdate')->withInput();
            }

            // Hapus foto lama kalau ada, lalu simpan yang baru
            if ($user->profile_picture) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_picture);
            }
            $validated['profile_picture'] = $path;
        }

        $user->update([
            'phone_no' => $validated['phone_no'] ?? null,
            'profile_picture' => $validated['profile_picture'] ?? $user->profile_picture,
        ]);

        return back()->with('profileStatus', 'Nomor telepon & foto profil berhasil diperbarui.');
    }

    /**
     * Ubah kata sandi akun mahasiswa yang sedang login.
     */
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

        // Dipanggil lewat AJAX dari halaman profil (biar halaman tidak reload
        // sama sekali, baik pas berhasil maupun gagal) -> selalu balas JSON.
        // Kalau validasi di atas gagal, Laravel otomatis balas JSON 422 juga
        // karena request AJAX ini ngirim header "Accept: application/json".
        return response()->json(['message' => 'Kata sandi berhasil diubah.']);
    }
}
