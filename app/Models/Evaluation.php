<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $fillable = ['student_id', 'group_id', 'status', 'created_by_id', 'updated_by_id'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function details()
    {
        return $this->hasMany(EvaluationDetail::class);
    }

    public function getRataRataAttribute(): ?float
    {
        $nilai = $this->details->pluck('value');
        return $nilai->count() ? round($nilai->avg(), 1) : null;
    }
}
