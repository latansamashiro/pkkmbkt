<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramStudy extends Model
{
    use SoftDeletes;

    protected $table = 'program_study';

    protected $fillable = ['faculty_id', 'code', 'name', 'created_by_id', 'updated_by_id'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}