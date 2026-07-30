<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamDetail extends Model
{
    use SoftDeletes;

    protected $table = 'exams_details';

    protected $fillable = [
        'exam_id',
        'question',
        'question_value',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'key',
        'created_by_id',
        'updated_by_id',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}