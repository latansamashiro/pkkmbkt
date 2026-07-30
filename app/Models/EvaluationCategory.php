<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluationCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'urutan', 'created_by_id', 'updated_by_id'];

    public function details()
    {
        return $this->hasMany(EvaluationDetail::class);
    }
}
