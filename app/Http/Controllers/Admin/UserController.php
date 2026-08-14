<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Member;
use App\Models\ProgramStudy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public const ROLES = [
        'SUPER-ADMIN' => 'SUPER ADMINISTRATOR',
        'ADVISOR' => 'ADVISOR (PEMBIMBING)',
        'MENTOR' => 'MENTOR',
        'STUDENT' => 'MAHASISWA',
        'COMMITTEE' => 'PANITIA',
    ];

    public const ROLES_WITH_ACADEMIC_FIELDS = ['STUDENT', 'MENTOR'];

    protected function lockedRole(Request $request): string
    {
        $role = $request->route('roleKey');
        abort_unless(array_key_exists($role, self::ROLES), 404);
        return $role;
    }

    protected function hasAcademicFields(string $role): bool
    {
        return in_array($role, self::ROLES_WITH_ACADEMIC_FIELDS, true);
    }

    protected function hasGroupField(string $role): bool
    {
        return $role === 'STUDENT';
    }

    protected function hasNpmField(string $role): bool
    {
        return $role === 'STUDENT';
    }

    protected function hasAdvisorTypeField(string $role): bool
    {
        return $role === 'ADVISOR';
    }

    public function index(Request $request)
    {
        $role = $this->lockedRole($request);

        $users = User::where('role_name', $role)
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'email',
                'role_name',
                'status',
                'phone_no',
                'faculty_name',
                'program_study_name',
                'gender',
                'npm',
                'advisor_type',
            ]);

        // dikirim ke FE buat isi dropdown Fakultas -> Prodi (nested by faculty)
        $faculties = Faculty::with(['programStudies' => fn($q) => $q->orderBy('name')])
            ->orderBy('name')
            ->get(['id', 'name']);

        $groups = [];
        if ($this->hasGroupField($role)) {
            $groups = Group::orderBy('name')->get(['id', 'code', 'name', 'max_member']);

            // tempel kelompok saat ini (kalau ada) ke tiap mahasiswa, buat prefill form edit
            $memberMap = Member::whereIn('student_id', $users->pluck('id'))->pluck('group_id', 'student_id');
            $users->each(function ($u) use ($memberMap) {
                $u->group_id = $memberMap[$u->id] ?? null;
            });
        }

        $data = ['title' => $request->route('title') ?? ('KELOLA ' . self::ROLES[$role])];
        $view = $request->route('view') ?? 'role.admin.user.index';

        return view($view, [
            'data' => $data,
            'users' => $users,
            'faculties' => $faculties,
            'groups' => $groups,
            'lockedRole' => $role,
            'roleLabel' => self::ROLES[$role],
            'showAcademic' => $this->hasAcademicFields($role),
            'showGroup' => $this->hasGroupField($role),
            'showNpm' => $this->hasNpmField($role),
            'showNim' => $this->hasNpmField($role), // alias — beberapa view (punya Panitia) pakai nama ini
            'showAdvisorType' => $this->hasAdvisorTypeField($role),
        ]);
    }

    protected function rulesAcademic(?string $currentFacultyName = null): array
    {
        return [
            'phone_no' => ['required', 'string', 'max:20'],
            'faculty_name' => ['required', 'string', 'max:255', Rule::exists('faculty', 'name')],
            'program_study_name' => [
                'required',
                'string',
                'max:255',
                Rule::exists('program_study', 'name')->where(function ($q) {
                    $faculty = Faculty::where('name', request('faculty_name'))->first();
                    $q->where('faculty_id', $faculty?->id);
                }),
            ],
            'gender' => ['required', Rule::in(['L', 'P'])],
        ];
    }

    protected function rulesGroup(): array
    {
        return [
            'group_id' => ['nullable', 'exists:groups,id'],
        ];
    }

    protected function rulesNpm(?int $ignoreId = null): array
    {
        $unique = Rule::unique('users', 'npm')->ignore($ignoreId);

        return [
            'npm' => ['nullable', 'string', 'max:30', $unique],
        ];
    }

    protected function rulesAdvisorType(): array
    {
        return [
            'advisor_type' => ['required', Rule::in(['pembimbing', 'koordinator'])],
        ];
    }

    protected function syncGroupMembership(User $user, ?int $groupId, int $actorId): void
    {
        if ($groupId) {
            Member::updateOrCreate(
                ['student_id' => $user->id],
                [
                    'group_id' => $groupId,
                    'created_by_id' => $actorId,
                    'updated_by_id' => $actorId,
                ]
            );
        } else {
            Member::where('student_id', $user->id)->delete();
        }
    }

    public function store(Request $request)
    {
        $role = $this->lockedRole($request);
        $academic = $this->hasAcademicFields($role);
        $groupField = $this->hasGroupField($role);
        $npmField = $this->hasNpmField($role);
        $advisorTypeField = $this->hasAdvisorTypeField($role);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ];

        if ($academic) {
            $rules += $this->rulesAcademic();
        }
        if ($groupField) {
            $rules += $this->rulesGroup();
        }
        if ($npmField) {
            $rules += $this->rulesNpm();
        }
        if ($advisorTypeField) {
            $rules += $this->rulesAdvisorType();
        }

        $validated = $request->validate($rules, [
            'email.unique' => 'Email sudah digunakan.',
            'npm.unique' => 'NPM sudah dipakai mahasiswa lain.',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_name' => $role,
            'status' => $validated['status'],
            'phone_no' => $validated['phone_no'] ?? null,
            'faculty_name' => $validated['faculty_name'] ?? null,
            'program_study_name' => $validated['program_study_name'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'npm' => $validated['npm'] ?? null,
            'advisor_type' => $validated['advisor_type'] ?? null,
            'created_by_id' => $request->user()->id,
            'updated_by_id' => $request->user()->id,
        ]);

        if ($groupField) {
            $this->syncGroupMembership($user, $validated['group_id'] ?? null, $request->user()->id);
            $user->group_id = $validated['group_id'] ?? null;
        }

        return response()->json([
            'message' => 'Pengguna baru berhasil ditambahkan.',
            'user' => $user->only([
                'id',
                'name',
                'email',
                'role_name',
                'status',
                'phone_no',
                'faculty_name',
                'program_study_name',
                'gender',
                'npm',
                'group_id',
                'advisor_type',
            ]),
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        $role = $this->lockedRole($request);
        $academic = $this->hasAcademicFields($role);
        $groupField = $this->hasGroupField($role);
        $npmField = $this->hasNpmField($role);
        $advisorTypeField = $this->hasAdvisorTypeField($role);

        abort_unless($user->role_name === $role, 404);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ];

        if ($academic) {
            $rules += $this->rulesAcademic();
        }
        if ($groupField) {
            $rules += $this->rulesGroup();
        }
        if ($npmField) {
            $rules += $this->rulesNpm($user->id);
        }
        if ($advisorTypeField) {
            $rules += $this->rulesAdvisorType();
        }

        $validated = $request->validate($rules, [
            'email.unique' => 'Email sudah digunakan.',
            'npm.unique' => 'NPM sudah dipakai mahasiswa lain.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->status = $validated['status'];
        $user->updated_by_id = $request->user()->id;

        if ($academic) {
            $user->phone_no = $validated['phone_no'];
            $user->faculty_name = $validated['faculty_name'];
            $user->program_study_name = $validated['program_study_name'];
            $user->gender = $validated['gender'];
        }

        if ($npmField) {
            $user->npm = $validated['npm'] ?? null;
        }

        if ($advisorTypeField) {
            $user->advisor_type = $validated['advisor_type'];
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        if ($groupField) {
            $this->syncGroupMembership($user, $validated['group_id'] ?? null, $request->user()->id);
            $user->group_id = $validated['group_id'] ?? null;
        }

        return response()->json([
            'message' => 'Data pengguna berhasil diperbarui.',
            'user' => $user->only([
                'id',
                'name',
                'email',
                'role_name',
                'status',
                'phone_no',
                'faculty_name',
                'program_study_name',
                'gender',
                'npm',
                'group_id',
                'advisor_type',
            ]),
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        $role = $this->lockedRole($request);
        abort_unless($user->role_name === $role, 404);

        if ($user->id === $request->user()->id) {
            return response()->json(['message' => 'Anda tidak bisa menghapus akun Anda sendiri.'], 422);
        }

        $user->delete();
        return response()->json(['message' => 'Pengguna berhasil dihapus.']);
    }

    /**
     * Download template CSV — kolomnya menyesuaikan role (STUDENT dapat
     * kolom NPM & Kode Kelompok, role lain tidak).
     */
    public function importTemplate(Request $request)
    {
        $role = $this->lockedRole($request);

        $header = ['Nama', 'Email', 'Password'];
        if ($this->hasNpmField($role)) {
            $header[] = 'NPM';
        }
        $header[] = 'No HP';
        $header[] = 'Jenis Kelamin (laki-laki/perempuan)';
        if ($this->hasAcademicFields($role)) {
            $header[] = 'Fakultas';
            $header[] = 'Program Studi';
        }
        if ($this->hasGroupField($role)) {
            $header[] = 'Kode Kelompok';
        }

        $contoh = ['NAZRUL IBRAHIM', 'nazrul@contoh.com', ''];
        if ($this->hasNpmField($role)) {
            $contoh[] = '525241019';
        }
        $contoh[] = '081234567890';
        $contoh[] = 'laki-laki';
        if ($this->hasAcademicFields($role)) {
            $contoh[] = 'FAKULTAS TEKNOLOGI INFORMASI';
            $contoh[] = 'TEKNIK INFORMATIKA';
        }
        if ($this->hasGroupField($role)) {
            $contoh[] = 'KLP-01';
        }

        $namaFile = 'template_import_' . strtolower(str_replace(' ', '_', self::ROLES[$role])) . '.csv';

        $callback = function () use ($header, $contoh) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM biar Excel baca UTF-8 dengan benar
            fputcsv($out, $header);
            fputcsv($out, $contoh);
            fclose($out);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$namaFile}\"",
        ]);
    }

    /**
     * Proses upload CSV — bikin banyak akun sekaligus. Baris yang gagal
     * (misal email/NPM sudah dipakai) dilewati, tidak menggagalkan baris lain,
     * lalu dilaporkan satu per satu di akhir.
     */
    public function import(Request $request)
    {
        $role = $this->lockedRole($request);
        $academic = $this->hasAcademicFields($role);
        $groupField = $this->hasGroupField($role);
        $npmField = $this->hasNpmField($role);

        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ]);

        $path = $request->file('file')->getRealPath();
        $handle = fopen($path, 'r');
        if (!$handle) {
            return response()->json(['message' => 'Gagal membaca file.'], 422);
        }

        // buang BOM UTF-8 kalau ada, biar kolom pertama (Nama) tidak kebaca aneh
        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        $header = fgetcsv($handle);
        if (!$header) {
            return response()->json(['message' => 'File kosong atau formatnya tidak terbaca.'], 422);
        }
        $header = array_map(fn($h) => strtolower(trim($h)), $header);

        $kolom = function (array $row, string $cari) use ($header) {
            foreach ($header as $i => $h) {
                if (str_contains($h, strtolower($cari))) {
                    return trim($row[$i] ?? '');
                }
            }
            return null;
        };

        $berhasil = [];
        $gagal = [];
        $baris = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $baris++;
            if (count(array_filter($row, fn($v) => trim((string) $v) !== '')) === 0) {
                continue; // baris kosong, lewati diam-diam
            }

            $nama = $kolom($row, 'nama');
            $email = $kolom($row, 'email');
            $password = $kolom($row, 'password');
            $npm = $npmField ? $kolom($row, 'npm') : null;
            $phone = $kolom($row, 'hp') ?? $kolom($row, 'telepon');
            $genderRaw = strtolower((string) $kolom($row, 'kelamin'));
            $gender = str_contains($genderRaw, 'perempuan') ? 'perempuan' : (str_contains($genderRaw, 'laki') ? 'laki-laki' : null);
            $fakultas = $academic ? $kolom($row, 'fakultas') : null;
            $prodi = $academic ? $kolom($row, 'program studi') : null;
            $kodeKelompok = $groupField ? $kolom($row, 'kelompok') : null;

            if (!$nama || !$email) {
                $gagal[] = "Baris {$baris}: Nama dan Email wajib diisi.";
                continue;
            }
            if (User::withTrashed()->where('email', $email)->exists()) {
                $gagal[] = "Baris {$baris} ({$email}): Email sudah dipakai (termasuk akun yang pernah dihapus).";
                continue;
            }
            if ($npm && User::withTrashed()->where('npm', $npm)->exists()) {
                $gagal[] = "Baris {$baris} ({$email}): NPM sudah dipakai (termasuk akun yang pernah dihapus).";
                continue;
            }

            $group = null;
            $kodeBelumAda = null;
            if ($kodeKelompok) {
                $group = \App\Models\Group::where('code', $kodeKelompok)->first();
                if (!$group) {
                    $kodeBelumAda = $kodeKelompok;
                    $gagal[] = "Baris {$baris} ({$email}): Kode Kelompok \"{$kodeKelompok}\" belum ada — akun dibuat tanpa kelompok dulu, nanti OTOMATIS masuk begitu kelompok dengan kode itu dibuat.";
                } elseif ($group->members()->count() >= $group->max_member) {
                    $gagal[] = "Baris {$baris} ({$email}): Kelompok \"{$kodeKelompok}\" sudah penuh, akun tetap dibuat tanpa kelompok.";
                    $group = null;
                }
            }

            $passwordAsli = $password ?: \Illuminate\Support\Str::random(8);

            $user = User::create([
                'name' => $nama,
                'email' => $email,
                'password' => Hash::make($passwordAsli),
                'role_name' => $role,
                'status' => 'aktif',
                'phone_no' => $phone ?: null,
                'faculty_name' => $fakultas ?: null,
                'program_study_name' => $prodi ?: null,
                'gender' => $gender,
                'npm' => $npm ?: null,
                'pending_group_code' => $kodeBelumAda,
                'created_by_id' => $request->user()->id,
                'updated_by_id' => $request->user()->id,
            ]);

            if ($group) {
                $this->syncGroupMembership($user, $group->id, $request->user()->id);
            }

            $berhasil[] = [
                'id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'password' => $passwordAsli,
                'kelompok' => $group->name ?? null,
                'prodi' => $prodi ?: null,
            ];
        }
        fclose($handle);

        return response()->json([
            'message' => count($berhasil) . ' akun berhasil dibuat' . (count($gagal) ? ', ' . count($gagal) . ' baris gagal/bermasalah.' : '.'),
            'berhasil' => $berhasil,
            'gagal' => $gagal,
        ]);
    }
}