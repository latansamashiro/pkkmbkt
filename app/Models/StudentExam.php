<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentExam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'exam_id',
        'exam_detail_id',
        'student_id',
        'question',
        'value',
        'created_by_id',
        'updated_by_id',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function examDetail()
    {
        return $this->belongsTo(ExamDetail::class, 'exam_detail_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}