<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        // peta student_id -> group_id, biar FE tahu siapa sudah di kelompok mana
        $memberMap = Member::pluck('group_id', 'student_id');

        $data = ['title' => $request->route('title') ?? 'Kelola Kelompok'];
        $view = $request->route('view') ?? 'role.admin.kelompok.index';

        return view($view, compact('data', 'groups', 'students', 'memberMap'));
    }

    /**
     * AJAX: data buat modal "Kelola Anggota" — anggota kelompok ini + daftar
     * mahasiswa yang masih available (belum tergabung kelompok manapun).
     */
    public function anggotaData(Group $group)
    {
        $group->loadCount('members');

        $memberIds = Member::where('group_id', $group->id)->pluck('student_id');
        $anggota = User::where('role_name', 'STUDENT')->whereIn('id', $memberIds)
            ->orderBy('name')->get(['id', 'name', 'email']);

        $terpakaiIds = Member::pluck('student_id');
        $tersedia = User::where('role_name', 'STUDENT')->whereNotIn('id', $terpakaiIds)
            ->orderBy('name')->get(['id', 'name', 'email', 'program_study_name']);

        return response()->json([
            'group' => [
                'id' => $group->id,
                'name' => $group->name,
                'code' => $group->code,
                'max_member' => $group->max_member,
                'member_count' => $group->members_count,
            ],
            'members' => $anggota,
            'available' => $tersedia,
        ]);
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

    /**
     * Upload Excel/CSV berisi kolom "npm" di baris pertama (header).
     * Mahasiswa yang NPM-nya cocok & belum punya kelompok langsung dimasukkan.
     * Tidak membuat akun baru — hanya mencocokkan mahasiswa yang SUDAH ada di sistem
     * (dari Kelola Mahasiswa Baru).
     */
    public function importMembers(Request $request, Group $group)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        $rows = \Maatwebsite\Excel\Facades\Excel::toArray([], $request->file('file'))[0] ?? [];

        if (empty($rows)) {
            return response()->json(['message' => 'File kosong atau formatnya tidak terbaca.'], 422);
        }

        $header = array_map(fn($h) => strtolower(trim((string) $h)), $rows[0]);
        $npmIdx = array_search('npm', $header);

        if ($npmIdx === false) {
            return response()->json(['message' => 'File harus punya kolom "npm" di baris pertama (header).'], 422);
        }

        $npms = collect($rows)->slice(1)
            ->map(fn($row) => trim((string) ($row[$npmIdx] ?? '')))
            ->filter()
            ->unique()
            ->values();

        $students = User::where('role_name', 'STUDENT')->whereIn('npm', $npms)->get()->keyBy('npm');
        $sudahPunyaKelompok = Member::pluck('student_id')->all();

        $ditambahkan = [];
        $dilewati = [];

        foreach ($npms as $npm) {
            $student = $students->get($npm);

            if (!$student) {
                $dilewati[] = "{$npm} (tidak ditemukan di Mahasiswa Baru)";
                continue;
            }
            if (in_array($student->id, $sudahPunyaKelompok, true)) {
                $dilewati[] = "{$student->name} (sudah punya kelompok)";
                continue;
            }
            if ($group->members()->count() + count($ditambahkan) >= $group->max_member) {
                $dilewati[] = "{$student->name} (kelompok sudah penuh)";
                continue;
            }

            Member::create([
                'group_id' => $group->id,
                'student_id' => $student->id,
                'created_by_id' => $request->user()->id,
                'updated_by_id' => $request->user()->id,
            ]);
            $ditambahkan[] = $student->name;
            $sudahPunyaKelompok[] = $student->id;
        }

        return response()->json([
            'message' => count($ditambahkan) . ' mahasiswa berhasil ditambahkan' . (count($dilewati) ? ', ' . count($dilewati) . ' dilewati.' : '.'),
            'ditambahkan' => $ditambahkan,
            'dilewati' => $dilewati,
            'member_count' => $group->members()->count(),
        ]);
    }
}