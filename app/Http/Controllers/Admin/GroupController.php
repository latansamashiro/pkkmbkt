<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Halaman Kelola Kelompok: daftar semua kelompok + jumlah anggota,
     * mentor, advisor. Anggota diatur lewat modal (AJAX) di halaman ini.
     */
    public function index(Request $request)
    {
        $groups = Group::with(['mentor:id,name', 'advisor:id,name'])
            ->withCount('members')
            ->orderBy('name')
            ->get();

        // semua mahasiswa (dipakai FE buat cari & nambah anggota per kelompok)
        $students = User::where('role_name', 'STUDENT')
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'program_study_name']);

        // dipakai buat dropdown Mentor/Advisor di form Tambah/Edit Kelompok
        // (form-nya submit ke endpoint Data Master yang sudah ada, type=kelompok)
        $mentors = User::where('role_name', 'MENTOR')->orderBy('name')->get(['id', 'name']);
        $advisors = User::where('role_name', 'ADVISOR')->orderBy('name')->get(['id', 'name']);

        // peta student_id -> group_id, biar FE tahu siapa sudah di kelompok mana
        $memberMap = Member::pluck('group_id', 'student_id');

        $data = ['title' => $request->route('title') ?? 'Kelola Kelompok'];
        $view = $request->route('view') ?? 'role.admin.kelompok.index';

        return view($view, compact('data', 'groups', 'students', 'mentors', 'advisors', 'memberMap'));
    }

    /**
     * Tambah satu mahasiswa ke kelompok. Menolak kalau mahasiswa itu
     * sudah ada di kelompok lain, atau kelompok sudah penuh.
     */
    public function addMember(Request $request, Group $group)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:users,id'],
        ]);

        $student = User::where('id', $validated['student_id'])
            ->where('role_name', 'STUDENT')
            ->firstOrFail();

        $existing = Member::where('student_id', $student->id)->first();
        if ($existing) {
            if ($existing->group_id === $group->id) {
                return response()->json(['message' => 'Mahasiswa ini sudah ada di kelompok ini.'], 422);
            }
            return response()->json(['message' => 'Mahasiswa ini sudah tergabung di kelompok lain. Keluarkan dulu dari kelompok lamanya.'], 422);
        }

        if ($group->members()->count() >= $group->max_member) {
            return response()->json(['message' => "Kelompok {$group->name} sudah penuh (maks. {$group->max_member} anggota)."], 422);
        }

        Member::create([
            'group_id' => $group->id,
            'student_id' => $student->id,
            'created_by_id' => $request->user()->id,
            'updated_by_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => "{$student->name} berhasil ditambahkan ke kelompok {$group->name}.",
            'student' => $student->only(['id', 'name', 'email']),
            'member_count' => $group->members()->count(),
        ]);
    }

    /**
     * Keluarkan satu mahasiswa dari kelompok.
     */
    public function removeMember(Request $request, Group $group, User $student)
    {
        $deleted = Member::where('group_id', $group->id)
            ->where('student_id', $student->id)
            ->delete();

        abort_unless($deleted, 404);

        return response()->json([
            'message' => "{$student->name} dikeluarkan dari kelompok {$group->name}.",
            'member_count' => $group->members()->count(),
        ]);
    }
}
