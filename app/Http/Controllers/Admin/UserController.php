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
            ]),
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        $role = $this->lockedRole($request);
        $academic = $this->hasAcademicFields($role);
        $groupField = $this->hasGroupField($role);
        $npmField = $this->hasNpmField($role);

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
}