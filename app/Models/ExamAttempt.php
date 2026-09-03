<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    protected $fillable = ['exam_id', 'student_id', 'attempts', 'cycle'];

    protected $casts = [
        'attempts' => 'integer',
        'cycle' => 'integer',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
