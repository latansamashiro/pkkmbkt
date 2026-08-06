<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentTask extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'task_id',
        'status',
        'created_by_id',
        'updated_by_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}