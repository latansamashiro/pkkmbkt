<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class DataMasterController extends Controller
{
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
                    ['key' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['aktif' => 'Published', 'nonaktif' => 'Draft']],
                ],
            ],
            'topik' => [
                'model' => Topic::class,
                'label' => 'Data Topik / Materi',
                'display' => 'title',
                'icon' => 'presentation',
                'chip' => 'bg-teal-50 text-teal-600',
                'list_cols' => ['title' => 'Judul', 'category' => 'Kategori', 'status' => 'Status'],
                'fields' => [
                    ['key' => 'title', 'label' => 'Judul Topik', 'type' => 'text', 'required' => true],
                    ['key' => 'description', 'label' => 'Deskripsi', 'type' => 'text', 'required' => true],
                    [
                        'key' => 'category',
                        'label' => 'Kategori',
                        'type' => 'select',
                        'required' => false,
                        'options' => [
                            'ebook' => 'E-Book',
                            'video' => 'Video',
                        ],
                    ],

                    ['key' => 'trainer', 'label' => 'Pemateri', 'type' => 'text', 'required' => false],
                    ['key' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['published' => 'Published', 'draft' => 'Draft']],
                    ['key' => 'file_link', 'label' => 'Link Video/File', 'type' => 'text', 'required' => false],
                ],
            ],
            'jadwal' => [
                'model' => Schedule::class,
                'label' => 'Data Jadwal',
                'display' => 'title',
                'icon' => 'calendar-days',
                'chip' => 'bg-lime-50 text-lime-600',
                'list_cols' => ['title' => 'Judul', 'Tempat', 'schedule_date' => 'Tanggal', 'status' => 'Status'],
                'fields' => [
                    ['key' => 'title', 'label' => 'Judul Kegiatan', 'type' => 'text', 'required' => true],
                    ['key' => 'place', 'label' => 'Tempat Kegiatan', 'type' => 'text', 'required' => true],
                    ['key' => 'schedule_date', 'label' => 'Tanggal', 'type' => 'date', 'required' => true],
                    ['key' => 'schedule_begin_time', 'label' => 'Jam Mulai', 'type' => 'time', 'required' => true],
                    ['key' => 'schedule_end_time', 'label' => 'Jam Selesai', 'type' => 'time', 'required' => true],
                    ['key' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['published' => 'Published', 'draft' => 'Draft']],
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
                            'jadwal' => 'Jadwal',
                            'umum' => 'Umum',
                            'tugas & evaluasi' => 'Tugas & Evaluasi',
                            'kelompok & mentor' => 'Kelompok & Mentor',
                        ],
                    ],
                    ['key' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['published' => 'Published', 'draft' => 'Draft']],
                    ['key' => 'important_flag', 'label' => 'Tandai Penting', 'type' => 'checkbox', 'required' => false],
                    ['key' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea', 'required' => false],
                ],
            ],
            'ujian' => [
                'model' => Exam::class,
                'label' => 'Data Evaluasi',
                'display' => 'title',
                'icon' => 'file-check-2',
                'chip' => 'bg-teal-50 text-teal-600',
                'list_cols' => ['title' => 'Judul', 'deskriptions', 'passing_grade' => 'Passing Grade'],
                'fields' => [
                    ['key' => 'title', 'label' => 'Judul Evaluasi', 'type' => 'text', 'required' => true],
                    ['key' => 'deskriptions', 'label' => 'Deskripsi', 'type' => 'text', 'required' => true],
                    ['key' => 'passing_grade', 'label' => 'Passing Grade', 'type' => 'number', 'required' => true],
                    ['key' => 'max_question', 'label' => 'Jumlah Soal', 'type' => 'number', 'required' => true],
                    ['key' => 'random_flag', 'label' => 'Acak Soal', 'type' => 'checkbox', 'required' => false],
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

    public function index()
    {
        $types = self::types();
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
                'fields' => $fields,
            ];
        }

        $data = ['title' => 'Kelola Data Master'];
        return view('role.admin.data-master.index', compact('data', 'categories'));
    }

    /**
     * AJAX: daftar item untuk satu kategori (dipanggil saat modal list dibuka).
     */
    public function items(string $type)
    {
        $cfg = $this->config($type);

        $rows = $cfg['model']::orderBy($cfg['display'])->get()
            ->map(fn($row) => [
                'id' => $row->id,
                ...collect($cfg['fields'])->mapWithKeys(
                    fn($f) => [$f['key'] => $row->{$f['key']}]
                )->all()
            ]);

        return response()->json(['data' => $rows]);
    }

    protected function rulesFor(array $cfg): array
    {
        $rules = [];
        foreach ($cfg['fields'] as $f) {
            if (!empty($f['virtual'])) {
                continue; // field UI-only, tidak masuk validasi/tidak disimpan
            }

            $r = [$f['required'] ? 'required' : 'nullable'];

            $r[] = match ($f['type']) {
                'number' => 'integer',
                'date' => 'date',
                'time' => 'date_format:H:i',
                'checkbox' => 'boolean',
                'select' => 'string',
                default => 'string',
            };

            if ($f['type'] === 'select' && isset($f['options']) && !isset($f['options_key'])) {
                $r[] = Rule::in(array_keys($f['options']));
            }

            $rules[$f['key']] = $r;
        }

        return $rules;
    }

    public function store(Request $request, string $type)
    {
        $cfg = $this->config($type);

        $validator = Validator::make($request->all(), $this->rulesFor($cfg));
        $validated = $validator->validate();

        foreach ($cfg['fields'] as $f) {
            if ($f['type'] === 'checkbox') {
                $validated[$f['key']] = (bool) ($validated[$f['key']] ?? false);
            }
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
        $cfg = $this->config($type);
        $row = $cfg['model']::findOrFail($id);

        $validator = Validator::make($request->all(), $this->rulesFor($cfg));
        $validated = $validator->validate();

        foreach ($cfg['fields'] as $f) {
            if ($f['type'] === 'checkbox') {
                $validated[$f['key']] = (bool) ($validated[$f['key']] ?? false);
            }
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
        $cfg = $this->config($type);
        $row = $cfg['model']::findOrFail($id);
        $row->delete();

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}