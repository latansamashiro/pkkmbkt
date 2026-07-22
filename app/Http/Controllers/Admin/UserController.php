<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Role sistem yang berlaku (harus sinkron dengan AccessRole middleware).
     */
    public const ROLES = [
        'super-admin' => 'Super Admin',
        'advisor' => 'Advisor (Pembimbing)',
        'mentor' => 'Mentor',
        'student' => 'Mahasiswa (Maba)',
        'committee' => 'Panitia',
    ];

    public function index()
    {
        $users = User::orderBy('name')->get([
            'id', 'name', 'email', 'role_name', 'status',
        ]);

        $data = [
            'title' => 'Kelola Pengguna',
        ];

        $roles = self::ROLES;

        return view('role.admin.user.index', compact('data', 'users', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role_name' => ['required', Rule::in(array_keys(self::ROLES))],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_name' => $validated['role_name'],
            'status' => $validated['status'],
            'created_by_id' => $request->user()->id,
            'updated_by_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Pengguna baru berhasil ditambahkan.',
            'user' => $user->only(['id', 'name', 'email', 'role_name', 'status']),
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role_name' => ['required', Rule::in(array_keys(self::ROLES))],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_name = $validated['role_name'];
        $user->status = $validated['status'];
        $user->updated_by_id = $request->user()->id;
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return response()->json([
            'message' => 'Data pengguna berhasil diperbarui.',
            'user' => $user->only(['id', 'name', 'email', 'role_name', 'status']),
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return response()->json([
                'message' => 'Anda tidak bisa menghapus akun Anda sendiri.',
            ], 422);
        }

        $user->delete();

        return response()->json([
            'message' => 'Pengguna berhasil dihapus.',
        ]);
    }
}
