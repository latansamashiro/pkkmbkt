<?php
namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupTask;
use App\Models\StudentTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskAssignmentController extends Controller
{
    /**
     * Data checklist untuk 1 tugas: daftar mahasiswa (kalau task_type=individu)
     * atau daftar kelompok (kalau task_type=kelompok), lengkap status assign
     * saat ini. Dipakai modal "Assign" di halaman Kelola Tugas.
     */
    public function show(Request $request, Task $task)
    {
        if ($task->task_type === 'kelompok') {
            $assignedIds = GroupTask::where('task_id', $task->id)->pluck('group_id')->all();

            $items = Group::orderBy('name')->get(['id', 'code', 'name'])
                ->map(fn ($g) => [
                    'id' => $g->id,
                    'label' => "{$g->code} - {$g->name}",
                    'checked' => in_array($g->id, $assignedIds, true),
                ])->values();
        } else {
            $assignedIds = StudentTask::where('task_id', $task->id)->pluck('student_id')->all();

            $items = User::where('role_name', 'STUDENT')->orderBy('name')->get(['id', 'name'])
                ->map(fn ($u) => [
                    'id' => $u->id,
                    'label' => $u->name,
                    'checked' => in_array($u->id, $assignedIds, true),
                ])->values();
        }

        return response()->json([
            'task' => $task->only(['id', 'title', 'task_type']),
            'items' => $items,
        ]);
    }

    /**
     * Simpan hasil ceklis: yang dicentang dipastikan punya baris assign
     * (status default 'ditugaskan'); yang tidak dicentang dihapus (soft delete)
     * kalau sebelumnya sudah ter-assign.
     */
    public function save(Request $request, Task $task)
    {
        $validated = $request->validate([
            'ids' => ['array'],
            'ids.*' => ['integer'],
        ]);
        $userId = $request->user()?->id;

        $model = $task->task_type === 'kelompok' ? GroupTask::class : StudentTask::class;
        $fkColumn = $task->task_type === 'kelompok' ? 'group_id' : 'student_id';

        // Saring ID yang beneran ada -- jaga-jaga kalau request-nya dimanipulasi
        // manual (mis. lewat DevTools) buat kirim ID kelompok/mahasiswa yang gak eksis.
        $idValid = $task->task_type === 'kelompok'
            ? Group::pluck('id')->all()
            : User::where('role_name', 'STUDENT')->pluck('id')->all();
        $checkedIds = array_values(array_intersect($validated['ids'] ?? [], $idValid));

        $existingIds = $model::where('task_id', $task->id)->pluck($fkColumn)->all();

        foreach (array_diff($checkedIds, $existingIds) as $newId) {
            $model::create([
                $fkColumn => $newId,
                'task_id' => $task->id,
                'status' => 'ditugaskan',
                'created_by_id' => $userId,
                'updated_by_id' => $userId,
            ]);
        }

        $model::where('task_id', $task->id)
            ->whereNotIn($fkColumn, $checkedIds)
            ->get()
            ->each(fn ($row) => $row->delete());

        return response()->json(['message' => 'Penugasan berhasil disimpan.']);
    }
}