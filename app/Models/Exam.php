<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'subtitle',
        'passing_grade',
        'max_question',
        'random_flag',
        'created_by_id',
        'updated_by_id',
    ];

    protected function casts(): array
    {
        return [
            'random_flag' => 'boolean',
        ];
    }

    public function details()
    {
        return $this->hasMany(ExamDetail::class);
    }

    public function studentExams()
    {
        return $this->hasMany(StudentExam::class);
    }
}