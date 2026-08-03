<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
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

        // dipakai buat dropdown filter Program Studi
        $faculties = Faculty::with(['programStudies' => fn($q) => $q->orderBy('name')])
            ->orderBy('name')
            ->get(['id', 'name']);

        $data = ['title' => $request->route('title') ?? 'Kelola Kelompok'];
        $view = $request->route('view') ?? 'role.admin.kelompok.index';

        return view($view, compact('data', 'groups', 'students', 'mentors', 'advisors', 'memberMap', 'faculties'));
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
     * Data buat modal "Kelola Anggota" — info kelompok + anggota saat ini +
     * daftar mahasiswa yang masih tersedia (belum punya kelompok manapun).
     */
    public function anggota(Group $group)
    {
        $group->loadCount('members');

        $members = Member::with('student:id,name,email')
            ->where('group_id', $group->id)
            ->get()
            ->map(fn($m) => $m->student?->only(['id', 'name', 'email']))
            ->filter()
            ->values();

        $sudahPunyaKelompok = Member::pluck('student_id');
        $available = User::where('role_name', 'STUDENT')
            ->whereNotIn('id', $sudahPunyaKelompok)
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'program_study_name']);

        return response()->json([
            'group' => [
                'id' => $group->id,
                'name' => $group->name,
                'member_count' => $group->members_count,
                'max_member' => $group->max_member,
            ],
            'members' => $members,
            'available' => $available,
        ]);
    }

    /**
     * Tambah banyak mahasiswa sekaligus ke SATU kelompok dari file CSV.
     * Kolom yang dibaca: NPM atau Email (salah satu boleh, dua-duanya juga boleh) —
     * dipakai buat mencocokkan ke akun mahasiswa yang SUDAH ADA (bukan bikin akun baru).
     */
    public function importMembers(Request $request, Group $group)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ]);

        $path = $request->file('file')->getRealPath();
        $handle = fopen($path, 'r');
        if (!$handle) {
            return response()->json(['message' => 'Gagal membaca file.'], 422);
        }

        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
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

        $ditambahkan = 0;
        $gagal = [];
        $baris = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $baris++;
            if (count(array_filter($row, fn($v) => trim((string) $v) !== '')) === 0) {
                continue;
            }

            $npm = $kolom($row, 'npm');
            $email = $kolom($row, 'email');

            $student = null;
            if ($npm) {
                $student = User::where('role_name', 'STUDENT')->where('npm', $npm)->first();
            }
            if (!$student && $email) {
                $student = User::where('role_name', 'STUDENT')->where('email', $email)->first();
            }

            if (!$student) {
                $gagal[] = "Baris {$baris}: mahasiswa dengan NPM/Email itu tidak ditemukan.";
                continue;
            }

            $existing = Member::where('student_id', $student->id)->first();
            if ($existing) {
                $gagal[] = "Baris {$baris} ({$student->name}): sudah tergabung di kelompok lain.";
                continue;
            }

            if ($group->members()->count() + $ditambahkan >= $group->max_member) {
                $gagal[] = "Baris {$baris} ({$student->name}): kelompok sudah penuh.";
                continue;
            }

            Member::create([
                'group_id' => $group->id,
                'student_id' => $student->id,
                'created_by_id' => $request->user()->id,
                'updated_by_id' => $request->user()->id,
            ]);
            $ditambahkan++;
        }
        fclose($handle);

        $pesan = "{$ditambahkan} mahasiswa berhasil ditambahkan";
        $pesan .= count($gagal) ? ', ' . count($gagal) . ' baris gagal/bermasalah.' : '.';

        return response()->json(['message' => $pesan, 'gagal' => $gagal]);
    }
}