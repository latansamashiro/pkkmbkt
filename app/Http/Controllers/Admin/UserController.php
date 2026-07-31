<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
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
            ]);

        // dikirim ke FE buat isi dropdown Fakultas -> Prodi (nested by faculty)
        $faculties = Faculty::with(['programStudies' => fn($q) => $q->orderBy('name')])
            ->orderBy('name')
            ->get(['id', 'name']);

        $data = ['title' => 'KELOLA ' . self::ROLES[$role]];

        return view('role.admin.user.index', [
            'data' => $data,
            'users' => $users,
            'faculties' => $faculties,
            'lockedRole' => $role,
            'roleLabel' => self::ROLES[$role],
            'showAcademic' => $this->hasAcademicFields($role),
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

    public function store(Request $request)
    {
        $role = $this->lockedRole($request);
        $academic = $this->hasAcademicFields($role);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ];

        if ($academic) {
            $rules += $this->rulesAcademic();
        }

        $validated = $request->validate($rules, [
            'email.unique' => 'Email sudah digunakan.',
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
            'created_by_id' => $request->user()->id,
            'updated_by_id' => $request->user()->id,
        ]);

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
            ]),
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        $role = $this->lockedRole($request);
        $academic = $this->hasAcademicFields($role);

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

        $validated = $request->validate($rules, [
            'email.unique' => 'Email sudah digunakan.',
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

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

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