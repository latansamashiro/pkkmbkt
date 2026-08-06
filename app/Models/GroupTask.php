<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupTask extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'group_id',
        'task_id',
        'status',
        'created_by_id',
        'updated_by_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}