<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceTemplate;
use App\Models\Exam;
use App\Models\Group;
use App\Models\Information;
use App\Models\ModuleItem;
use App\Models\Schedule;
use App\Models\Topic;
use App\Models\User;
use App\Models\ProgramStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\EvaluationCategory;
use App\Models\ExamDetail;

class DataMasterController extends Controller
{
    /**
     * Jam sesi absensi FIXED (sesuai Ketentuan Absensi) — Panitia cuma
     * masukin tanggal, 3 sesi ini otomatis dibuat untuk tanggal itu.
     */
    protected const SESI_ABSENSI_FIXED = [
        ['session_name' => 'Sesi 1', 'time_begin' => '08:00', 'time_end' => '10:00'],
        ['session_name' => 'Sesi 2', 'time_begin' => '13:00', 'time_end' => '15:00'],
        ['session_name' => 'Sesi 3', 'time_begin' => '16:00', 'time_end' => '18:00'],
    ];

    /**
     * Tambah satu HARI presensi sekaligus — otomatis membuat 3 sesi fixed
     * (08.00-10.00, 13.00-15.00, 16.00-18.00) untuk tanggal yang dipilih.
     * Kalau salah satu sesi di tanggal itu sudah ada, dilewati saja (tidak dobel).
     */
    public function jadwalAbsensiStoreHari(Request $request)
    {
        $validated = $request->validate([
            'attendance_date' => ['required', 'date'],
        ]);

        $dayName = \Carbon\Carbon::parse($validated['attendance_date'])->locale('id')->translatedFormat('l');

        $dibuat = [];
        foreach (self::SESI_ABSENSI_FIXED as $sesi) {
            $row = \App\Models\AttendanceTemplate::withTrashed()->firstOrCreate(
                [
                    'attendance_date' => $validated['attendance_date'],
                    'session_name' => $sesi['session_name'],
                ],
                [
                    'day_name' => $dayName,
                    'time_begin' => $sesi['time_begin'],
                    'time_end' => $sesi['time_end'],
                    'created_by_id' => $request->user()->id,
                    'updated_by_id' => $request->user()->id,
                ]
            );
            if ($row->trashed()) {
                $row->restore(); // sesi ini pernah dihapus & dibuat ulang -> hidupkan lagi, bukan bikin baris baru
            }
            $dibuat[] = $row;
        }

        return response()->json([
            'message' => 'Hari & 3 sesi absensi berhasil ditambahkan.',
            'data' => $dibuat,
        ], 201);
    }

    /**
     * Konfigurasi tiap jenis data master.
     * - model     : class Eloquent yang dipakai
     * - label     : judul yang tampil di card & modal
     * - icon      : nama icon lucide untuk card
     * - chip      : class tailwind warna badge icon
     * - list_cols : kolom yang ditampilkan di tabel dalam modal (key => label)
     * - fields    : skema field form (dipakai FE untuk build form otomatis)
     *   type: text | textarea | number | date | time | select | checkbox
     */
    public static function types(): array
    {
        return [
            'kelompok' => [
                'model' => Group::class,
                'label' => 'Data Kelompok',
                'display' => 'name',
                'icon' => 'users-round',
                'chip' => 'bg-rose-50 text-rose-500',
                'list_cols' => ['code' => 'Kode', 'name' => 'Nama'],
                'fields' => [
                    ['key' => 'code', 'label' => 'Kode Kelompok', 'type' => 'text', 'required' => true],
                    ['key' => 'name', 'label' => 'Nama Kelompok', 'type' => 'text', 'required' => true],
                    ['key' => 'program_study_filter', 'label' => 'Program Studi', 'type' => 'select', 'required' => false, 'options_key' => 'program_studies', 'virtual' => true],
                    ['key' => 'mentor_id', 'label' => 'Mentor', 'type' => 'select', 'required' => false, 'options_key' => 'mentors', 'filter_by' => 'program_study_filter'],
                    ['key' => 'advisor_id', 'label' => 'Advisor', 'type' => 'select', 'required' => false, 'options_key' => 'advisors'],
                    ['key' => 'max_member', 'label' => 'Maks. Anggota', 'type' => 'number', 'required' => true],
                ],
            ],
            'jadwal_absensi' => [
                'model' => AttendanceTemplate::class,
                'label' => 'Jadwal Absensi (Hari & Sesi)',
                'display' => 'attendance_date',
                'icon' => 'calendar-clock',
                'chip' => 'bg-teal-50 text-teal-600',
                'list_cols' => [
                    'day_name' => 'Hari',
                    'session_name' => 'Sesi',
                    'attendance_date' => 'Tanggal',
                    'time_begin' => 'Jam Mulai',
                    'time_end' => 'Jam Selesai',
                ],
                'fields' => [
                    ['key' => 'session_name', 'label' => 'Sesi', 'type' => 'select', 'required' => true, 'options' => [
                        'Sesi 1' => 'Sesi 1',
                        'Sesi 2' => 'Sesi 2',
                        'Sesi 3' => 'Sesi 3',
                        'Sesi 4' => 'Sesi 4',
                    ]],
                    ['key' => 'attendance_date', 'label' => 'Tanggal', 'type' => 'date', 'required' => true],
                    ['key' => 'time_begin', 'label' => 'Jam Mulai', 'type' => 'time', 'required' => true],
                    ['key' => 'time_end', 'label' => 'Jam Selesai', 'type' => 'time', 'required' => true],
                ],
            ],
            'modul' => [
                'model' => ModuleItem::class,
                'label' => 'Data Modul',
                'display' => 'section',
                'icon' => 'book-open',
                'chip' => 'bg-indigo-50 text-indigo-600',
                'list_cols' => ['section' => 'Judul', 'status' => 'Status'],
                'fields' => [
                    ['key' => 'section', 'label' => 'Judul', 'type' => 'text', 'required' => true],
                    ['key' => 'content', 'label' => 'Konten', 'type' => 'textarea', 'required' => false],
                    ['key' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['aktif' => 'PUBLISHED', 'draft' => 'DRAFT']],
                ],
            ],
            'topik' => [
                'model' => Topic::class,
                'label' => 'Data Topik / Materi',
                'display' => 'title',
                'icon' => 'presentation',
                'chip' => 'bg-teal-50 text-teal-600',
                'list_cols' => [
                    'title' => 'Judul',
                    'topic_type' => 'Jenis Topik',
                    'category' => 'Kategori',
                    'trainer' => 'Pemateri',
                    'status' => 'Status',
                ],
                'fields' => [
                    ['key' => 'title', 'label' => 'Judul Topik', 'type' => 'text', 'required' => true],
                    [
                        'key' => 'topic_type',
                        'label' => 'Jenis Topik',
                        'type' => 'select',
                        'required' => true,
                        'options' => [
                            'keunilaman' => 'SEJARAH UNILAM',
                            'akademik' => 'AKADEMIK',
                            'lkms' => 'LKMS',
                            'perpustakaan' => 'PERPUSTAKAAN',
                            'kemahasiswaan' => 'KEMAHASISWAAN',
                            'narasumber eskternal' => 'NARASUMBER EXTERNAL',
                        ],
                    ],
                    [
                        'key' => 'category',
                        'label' => 'Kategori',
                        'type' => 'select',
                        'required' => true,
                        'options' => [
                            'ebook' => 'E-BOOK',
                            'video' => 'VIDEO',
                        ],
                    ],
                    ['key' => 'trainer', 'label' => 'Pemateri', 'type' => 'text', 'required' => false],
                    ['key' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['published' => 'PUBLISHED', 'draft' => 'DRAFT']],
                    ['key' => 'file_link', 'label' => 'Link Video/File', 'type' => 'text', 'required' => false],
                ],
            ],

            'jadwal' => [
                'model' => Schedule::class,
                'label' => 'Data Jadwal',
                'display' => 'title',
                'icon' => 'calendar-days',
                'chip' => 'bg-lime-50 text-lime-600',
                'list_cols' => ['title' => 'Judul', 'place' => 'Tempat', 'schedule_date' => 'Tanggal', 'schedule_begin_time' => 'Jam Mulai', 'schedule_end_time' => 'Jam Selesai', 'status' => 'Status'],
                'fields' => [
                    ['key' => 'title', 'label' => 'Judul Kegiatan', 'type' => 'text', 'required' => true],
                    ['key' => 'place', 'label' => 'Tempat Kegiatan', 'type' => 'text', 'required' => true],
                    ['key' => 'schedule_date', 'label' => 'Tanggal', 'type' => 'date', 'required' => true],
                    ['key' => 'schedule_begin_time', 'label' => 'Jam Mulai', 'type' => 'time', 'required' => true],
                    ['key' => 'schedule_end_time', 'label' => 'Jam Selesai', 'type' => 'time', 'required' => true],
                    ['key' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['published' => 'PUBLISHED', 'draft' => 'DRAFT']],
                    ['key' => 'pic', 'label' => 'PIC', 'type' => 'text', 'required' => false],
                    ['key' => 'important_flag', 'label' => 'Kegiatan Penting', 'type' => 'checkbox', 'required' => false],
                    ['key' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea', 'required' => false],
                ],
            ],
            'informasi' => [
                'model' => Information::class,
                'label' => 'Data Informasi / Pengumuman',
                'display' => 'title',
                'icon' => 'megaphone',
                'chip' => 'bg-indigo-50 text-indigo-600',
                'list_cols' => ['title' => 'Judul', 'category' => 'Kategori', 'status' => 'Status'],
                'fields' => [
                    ['key' => 'title', 'label' => 'Judul', 'type' => 'text', 'required' => true],
                    [
                        'key' => 'category',
                        'label' => 'Kategori',
                        'type' => 'select',
                        'required' => false,
                        'options' => [
                            'jadwal' => 'JADWAL',
                            'umum' => 'UMUM',
                            'tugas & evaluasi' => 'TUGAS & EVALUASI',
                            'kelompok & mentor' => 'KELOMPOK & MENTOR',
                            'darurat' => 'DARURAT',
                        ],
                    ],
                    ['key' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['published' => 'PUBLISHED', 'draft' => 'DRAFT']],
                    ['key' => 'important_flag', 'label' => 'Tandai Penting', 'type' => 'checkbox', 'required' => false],
                    ['key' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea', 'required' => false],
                ],
            ],
            'ujian' => [
                'model' => Exam::class,
                'label' => 'Data Soal Evaluasi',
                'display' => 'title',
                'icon' => 'file-check-2',
                'chip' => 'bg-teal-50 text-teal-600',
                'list_cols' => ['title' => 'Kategori', 'subtitle' => 'Judul', 'passing_grade' => 'Passing Grade'],
                'fields' => [
                    ['key' => 'title', 'label' => 'Kategori Evaluasi', 'type' => 'select', 'required' => true, 'options_key' => 'evaluation_categories'],
                    ['key' => 'subtitle', 'label' => 'Judul', 'type' => 'text', 'required' => true],
                    ['key' => 'passing_grade', 'label' => 'Passing Grade', 'type' => 'number', 'required' => true],
                    ['key' => 'max_question', 'label' => 'Jumlah Soal', 'type' => 'number', 'required' => true],
                    ['key' => 'random_flag', 'label' => 'Acak Soal', 'type' => 'checkbox', 'required' => false],
                ],
            ],
            'kategori_evaluasi' => [
                'model' => EvaluationCategory::class,
                'label' => 'Kategori Evaluasi',
                'display' => 'name',
                'icon' => 'clipboard-list',
                'chip' => 'bg-purple-50 text-purple-600',
                'list_cols' => ['name' => 'Nama Kategori', 'urutan' => 'Urutan'],
                'fields' => [
                    ['key' => 'name', 'label' => 'Nama Kategori', 'type' => 'text', 'required' => true],
                    ['key' => 'urutan', 'label' => 'Urutan Tampil', 'type' => 'number', 'required' => true, 'unique' => 'evaluation_categories,urutan'],
                ],
            ],
                        // ===== 2) Tambahkan entri 'soal' di dalam types(), taruh persis setelah entri 'ujian' =====
            
            'soal' => [
                'model' => ExamDetail::class,
                'label' => 'Bank Soal',
                'display' => 'id',
                'icon' => 'list-checks',
                'chip' => 'bg-slate-50 text-slate-600',
                'list_cols' => ['question' => 'Pertanyaan', 'key' => 'Kunci'],
                'scope_field' => 'exam_id', // data ini terikat ke satu Paket Evaluasi (exam_id), bukan berdiri sendiri
                'fields' => [
                    ['key' => 'question', 'label' => 'Pertanyaan', 'type' => 'textarea', 'required' => true],
                    ['key' => 'question_value', 'label' => 'Bobot Nilai', 'type' => 'number', 'required' => true],
                    ['key' => 'option_a', 'label' => 'Opsi A', 'type' => 'text', 'required' => true],
                    ['key' => 'option_b', 'label' => 'Opsi B', 'type' => 'text', 'required' => true],
                    ['key' => 'option_c', 'label' => 'Opsi C', 'type' => 'text', 'required' => true],
                    ['key' => 'option_d', 'label' => 'Opsi D', 'type' => 'text', 'required' => true],
                    ['key' => 'key', 'label' => 'Kunci Jawaban', 'type' => 'select', 'required' => true, 'options' => ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D']],
                    ],
                ],
        ];
    }

    protected function config(string $type): array
    {
        $types = self::types();
        abort_unless(array_key_exists($type, $types), 404);

        return $types[$type];
    }

    protected function optionSources(): array
    {
        return [
            'mentors' => User::where('role_name', 'MENTOR')->orderBy('name')->get(['id', 'name'])
                ->mapWithKeys(fn($u) => [$u->id => $u->name]),
            'advisors' => User::where('role_name', 'ADVISOR')->orderBy('name')->get(['id', 'name'])
                ->mapWithKeys(fn($u) => [$u->id => $u->name]),
            'program_studies' => ProgramStudy::orderBy('name')->get(['name'])
                ->mapWithKeys(fn($p) => [$p->name => $p->name]),
            'evaluation_categories' => EvaluationCategory::orderBy('urutan')->get(['name'])
                ->mapWithKeys(fn($c) => [$c->name => 'EVALUASI ' . $c->name]),
        ];
    }

    protected function optionMetaSources(): array
    {
        return [
            'mentors' => User::where('role_name', 'MENTOR')->orderBy('name')->get(['id', 'name', 'program_study_name'])
                ->map(fn($u) => ['value' => $u->id, 'label' => $u->name, 'filter_value' => $u->program_study_name])
                ->values(),
        ];
    }

    /**
     * Cek apakah $type ini boleh diakses lewat route saat ini.
     * Route bisa titip default 'onlyTypes' => ['jadwal'] misalnya, untuk membatasi
     * area tertentu (mis. Committee) hanya boleh CRUD kategori tertentu saja.
     */
    protected function assertTypeAllowed(Request $request, string $type): void
    {
        $only = $request->route('onlyTypes');
        if ($only && !in_array($type, $only, true)) {
            abort(404);
        }
    }

    public function index(Request $request)
    {
        $types = self::types();

        // Kalau route ini dibatasi (mis. Committee cuma boleh 'jadwal'), filter di sini
        $only = $request->route('onlyTypes');
        if ($only) {
            $types = array_intersect_key($types, array_flip($only));
        }

        $sources = $this->optionSources();
        $metaSources = $this->optionMetaSources();

        $categories = [];
        foreach ($types as $key => $cfg) {
            $fields = $cfg['fields'];
            foreach ($fields as &$f) {
                if (isset($f['options_key'])) {
                    $f['options'] = $sources[$f['options_key']] ?? [];
                }
                if (isset($f['filter_by']) && isset($metaSources[$f['options_key']])) {
                    $f['options_meta'] = $metaSources[$f['options_key']];
                }
                $f['name'] = $f['key'];
            }
            unset($f);

            $categories[] = [
                'key' => $key,
                'label' => $cfg['label'],
                'icon' => $cfg['icon'],
                'chip' => $cfg['chip'],
                'total' => $cfg['model']::count(),
                'display' => $cfg['display'],
                'list_cols' => $cfg['list_cols'],
                'fields' => $fields,
            ];
        }

        $data = ['title' => $request->route('title') ?? 'Kelola Data Master'];
        $view = $request->route('view') ?? 'role.admin.data-master.index';

        return view($view, compact('data', 'categories'));
    }

    /**
     * AJAX: daftar item untuk satu kategori (dipanggil saat modal list dibuka).
     */
    public function items(Request $request, string $type)
    {
        $this->assertTypeAllowed($request, $type);
        $cfg = $this->config($type);
    
        $query = $cfg['model']::query();
 
    if (!empty($cfg['scope_field'])) {
        $scopeValue = $request->query($cfg['scope_field']);
        abort_if(!$scopeValue, 422, "Parameter {$cfg['scope_field']} wajib diisi.");
        $query->where($cfg['scope_field'], $scopeValue);
        }
 
    $rows = $query->orderBy($cfg['display'])->get()
        ->map(function ($row) use ($cfg) {
            $data = ['id' => $row->id];
            foreach ($cfg['fields'] as $f) {
                $value = $row->{$f['key']};
                if ($f['type'] === 'date' && $value) {
                    $value = \Carbon\Carbon::parse($value)->format('Y-m-d');
                }
                $data[$f['key']] = $value;
            }
            return $data;
        });
 
        return response()->json(['data' => $rows]);
    }

    protected function rulesFor(array $cfg, ?int $ignoreId = null): array
    {
        $rules = [];
        foreach ($cfg['fields'] as $f) {
            if (!empty($f['virtual'])) {
                continue;
            }

            $r = [$f['required'] ? 'required' : 'nullable'];

            $r[] = match ($f['type']) {
                'number' => 'integer',
                'date' => 'date',
                'time' => 'date_format:H:i,H:i:s',
                'checkbox' => 'boolean',
                'select' => 'string',
                default => 'string',
            };

            if ($f['type'] === 'select' && isset($f['options']) && !isset($f['options_key'])) {
                $r[] = Rule::in(array_keys($f['options']));
            }

            if (!empty($f['unique'])) {
                [$table, $column] = explode(',', $f['unique']);
                $uniqueRule = Rule::unique($table, $column);
                if ($ignoreId) {
                    $uniqueRule = $uniqueRule->ignore($ignoreId);
                }
                $r[] = $uniqueRule;
            }

            $rules[$f['key']] = $r;
        }

        return $rules;
    }

   public function store(Request $request, string $type)
{
    $this->assertTypeAllowed($request, $type);
    $cfg = $this->config($type);
 
    $validator = Validator::make($request->all(), $this->rulesFor($cfg, null), $this->messagesFor($cfg));
    $validated = $validator->validate();
 
    foreach ($cfg['fields'] as $f) {
        if ($f['type'] === 'checkbox') {
            $validated[$f['key']] = (bool) ($validated[$f['key']] ?? false);
        }
        if ($f['type'] === 'time' && !empty($validated[$f['key']])) {
            $validated[$f['key']] = \Carbon\Carbon::createFromFormat(
                strlen($validated[$f['key']]) === 5 ? 'H:i' : 'H:i:s',
                $validated[$f['key']]
            )->format('H:i:s');
        }
    }
        // "Nama Hari" tidak diisi manual — otomatis dari tanggal yang dipilih.
        if ($type === 'jadwal_absensi' && !empty($validated['attendance_date'])) {
            $validated['day_name'] = \Carbon\Carbon::parse($validated['attendance_date'])->locale('id')->translatedFormat('l');

            $sudahAda = \App\Models\AttendanceTemplate::withTrashed()->where('attendance_date', $validated['attendance_date'])
                ->where('session_name', $validated['session_name'])
                ->exists();
            abort_if($sudahAda, 422, "{$validated['session_name']} untuk tanggal itu sudah ada, tidak boleh dobel.");
        }
        if (!empty($cfg['scope_field'])) {
            $scopeValue = $request->input($cfg['scope_field']);
            abort_if(!$scopeValue, 422, "Parameter {$cfg['scope_field']} wajib diisi.");
            $validated[$cfg['scope_field']] = $scopeValue;
        }
    
        if ($request->user()) {
            $validated['created_by_id'] = $request->user()->id;
            $validated['updated_by_id'] = $request->user()->id;
        }
    
        $row = $cfg['model']::create($validated);
    
        return response()->json([
            'message' => 'Data berhasil ditambahkan.',
            'data' => $row,
        ], 201);
    }


       
    public function update(Request $request, string $type, int $id)
    {
        $this->assertTypeAllowed($request, $type);
        $cfg = $this->config($type);
        $row = $cfg['model']::findOrFail($id);

        $validator = Validator::make($request->all(), $this->rulesFor($cfg, $id), $this->messagesFor($cfg));
        $validated = $validator->validate();

        foreach ($cfg['fields'] as $f) {
            if ($f['type'] === 'checkbox') {
                $validated[$f['key']] = (bool) ($validated[$f['key']] ?? false);
            }
            if ($f['type'] === 'time' && !empty($validated[$f['key']])) {
                // pastikan selalu tersimpan sebagai H:i:s
                $validated[$f['key']] = \Carbon\Carbon::createFromFormat(
                    strlen($validated[$f['key']]) === 5 ? 'H:i' : 'H:i:s',
                    $validated[$f['key']]
                )->format('H:i:s');
            }
        }

        // "Nama Hari" tidak diisi manual — otomatis dari tanggal yang dipilih.
        if ($type === 'jadwal_absensi' && !empty($validated['attendance_date'])) {
            $validated['day_name'] = \Carbon\Carbon::parse($validated['attendance_date'])->locale('id')->translatedFormat('l');

            $sudahAda = \App\Models\AttendanceTemplate::withTrashed()->where('attendance_date', $validated['attendance_date'])
                ->where('session_name', $validated['session_name'])
                ->where('id', '!=', $id)
                ->exists();
            abort_if($sudahAda, 422, "{$validated['session_name']} untuk tanggal itu sudah ada, tidak boleh dobel.");
        }

        if ($request->user()) {
            $validated['updated_by_id'] = $request->user()->id;
        }

        $row->update($validated);

        return response()->json([
            'message' => 'Data berhasil diperbarui.',
            'data' => $row,
        ]);
    }

    public function destroy(Request $request, string $type, int $id)
    {
        $this->assertTypeAllowed($request, $type);
        $cfg = $this->config($type);
        $row = $cfg['model']::findOrFail($id);
        $row->delete();

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }

    /**
     * Toggle boolean 'important_flag' — dipakai oleh tombol bintang (⭐).
     * Hanya berlaku kalau kategori punya field 'important_flag'.
     */
    public function toggleImportant(Request $request, string $type, int $id)
    {
        $this->assertTypeAllowed($request, $type);
        $cfg = $this->config($type);

        $hasField = collect($cfg['fields'])->contains(fn ($f) => $f['key'] === 'important_flag');
        abort_unless($hasField, 404);

        $row = $cfg['model']::findOrFail($id);
        $row->important_flag = !$row->important_flag;
        if ($request->user()) {
            $row->updated_by_id = $request->user()->id;
        }
        $row->save();

        return response()->json([
            'message' => $row->important_flag ? 'Ditandai penting.' : 'Tanda penting dihapus.',
            'data' => $row,
        ]);
    }

    /**
     * Toggle antara dua opsi field 'status' (mis. published <-> draft) —
     * dipakai oleh tombol mata (👁). Berlaku untuk kategori apa pun yang
     * field 'status'-nya berupa select dengan opsi (options) statis.
     */
    public function togglePublish(Request $request, string $type, int $id)
    {
        $this->assertTypeAllowed($request, $type);
        $cfg = $this->config($type);

        $statusField = collect($cfg['fields'])->firstWhere('key', 'status');
        abort_unless($statusField && !empty($statusField['options']), 404);

        $options = array_keys($statusField['options']);
        $row = $cfg['model']::findOrFail($id);

        $lainnya = collect($options)->first(fn ($o) => $o !== $row->status) ?? $row->status;
        $row->status = $lainnya;
        if ($request->user()) {
            $row->updated_by_id = $request->user()->id;
        }
        $row->save();

        return response()->json([
            'message' => "Status diubah menjadi {$lainnya}.",
            'data' => $row,
        ]);
    }

    protected function messagesFor(array $cfg): array
    {
        $messages = [];
        foreach ($cfg['fields'] as $f) {
            if (!empty($f['unique'])) {
                $messages["{$f['key']}.unique"] = "{$f['label']} sudah dipakai, pilih angka lain.";
            }
        }
        return $messages;
    }
}