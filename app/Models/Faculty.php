<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;

    protected $table = 'faculty';

    protected $fillable = ['code', 'name', 'created_by_id', 'updated_by_id'];

    public function programStudies()
    {
        return $this->hasMany(ProgramStudy::class);
    }
}