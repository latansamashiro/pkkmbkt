<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAttemptScore extends Model
{
    protected $fillable = ['exam_id', 'student_id', 'attempt_number', 'skor'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
