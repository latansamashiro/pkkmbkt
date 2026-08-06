<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'title',
    'description',
    'task_type',
    'deadline',
    'status',
    'created_by_id',
    'updated_by_id',
];

    public function studentTasks()
    {
        return $this->hasMany(StudentTask::class);
    }

    public function groupTasks()
    {
        return $this->hasMany(GroupTask::class);
    }
}