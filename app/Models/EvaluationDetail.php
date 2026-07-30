<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluationDetail extends Model
{
    protected $fillable = ['evaluation_id', 'evaluation_category_id', 'value'];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function category()
    {
        return $this->belongsTo(EvaluationCategory::class);
    }
}