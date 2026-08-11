<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function modul()
    {
        return view('role.student.modul');
    }

    public function leaderboard()
    {
        $dataMahasiswa = \App\Support\Leaderboard::hitungRanking();

        return view('role.student.leaderboard', compact('dataMahasiswa'));
    }

    public function dashboard()
    {
        $jadwalHariIni = \App\Models\Schedule::where('status', 'published')
            ->whereDate('schedule_date', today())
            ->orderBy('schedule_begin_time')
            ->get();

        return view('role.student.dashboard', compact('jadwalHariIni'));
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
            ->map(fn ($a) => [
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

        $gradients = [
            'from-teal-600 to-blue-800', 'from-purple-600 to-indigo-800', 'from-amber-500 to-orange-700',
            'from-cyan-600 to-blue-800', 'from-purple-600 to-pink-700', 'from-indigo-600 to-purple-800',
        ];

        $mapItem = function ($t, $idx) use ($gradients) {
            return [
                'id' => ($t->category === 'video' ? 'vid-' : 'doc-') . $t->id,
                'tipe' => $t->category,
                'judul' => $t->title,
                'deskripsi' => '-',
                'pemateri' => $t->trainer ?? '-',
                'durasi' => '-',
                'youtube' => $t->category === 'video' ? ($t->file_link ?? '#') : null,
                'pdf' => $t->category === 'ebook' ? ($t->file_link ?? '#') : null,
                'fileSize' => '-',
                'updatedAt' => $t->updated_at?->translatedFormat('d F Y'),
                'thumbnailImg' => '',
                'gradientFallback' => $gradients[$idx % count($gradients)],
                'progress' => 0,
                'tags' => array_values(array_filter([$t->category, $t->topic_type])),
            ];
        };

        $videoMateri = $topics->where('category', 'video')->values()->map(fn($t, $i) => $mapItem($t, $i));
        $ebookMateri = $topics->where('category', 'ebook')->values()->map(fn($t, $i) => $mapItem($t, $i));

        return view('role.student.materi', compact('videoMateri', 'ebookMateri'));
    }

    public function denahKampus()
    {
        return view('role.student.denah-kampus');
    }

    public function evaluasi()
    {
        $exams = \App\Models\Exam::with('details')->orderBy('title')->get();

        $studentExams = \App\Models\StudentExam::where('student_id', auth()->id())
            ->whereIn('exam_id', $exams->pluck('id'))
            ->get()
            ->groupBy('exam_id');

        // Berapa kali mahasiswa ini udah "Mulai/Ulangi Kuis" per paket evaluasi
        // -- dipakai buat batasin maksimal 3x percobaan (lihat evaluasiMulaiAttempt()).
        $attemptMap = \App\Models\ExamAttempt::where('student_id', auth()->id())
            ->whereIn('exam_id', $exams->pluck('id'))
            ->get()
            ->keyBy('exam_id');

        $hurufKeIndex = ['a' => 0, 'b' => 1, 'c' => 2, 'd' => 3];
        $warnaPalet = [
            'linear-gradient(135deg,#f59e0b,#c2410c)', 'linear-gradient(135deg,#0d9488,#1e40af)',
            'linear-gradient(135deg,#9333ea,#3730a3)', 'linear-gradient(135deg,#dc2626,#7c2d12)',
            'linear-gradient(135deg,#2563eb,#1e3a8f)', 'linear-gradient(135deg,#16a34a,#14532d)',
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
            $rows = $studentExams->get($exam->id);
            if ($rows && $rows->count() > 0) {
                $total = $exam->details->count();
                $benar = 0;
                foreach ($rows as $r) {
                    $detail = $exam->details->firstWhere('id', $r->exam_detail_id);
                    if ($detail && strtolower($r->value) === strtolower($detail->key)) {
                        $benar++;
                    }
                }
                $statusAwal[(string) $exam->id] = [
                    'skorTerbaik' => $total ? (int) round($benar / $total * 100) : 0,
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

        return response()->json([
            'message' => 'Hasil kuis berhasil dikirim.',
            'skor' => $skor,
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
            // Hapus foto lama kalau ada, lalu simpan yang baru
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
     * Ubah kata sandi akun mahasiswa yang sedang login.
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
}
