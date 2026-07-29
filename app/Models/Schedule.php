<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
         'place',  
        'schedule_date',
        'schedule_begin_time',
        'schedule_end_time',
        'status',
        'pic',
        'important_flag',
        'description',
        'created_by_id',
        'updated_by_id',
    ];

    protected function casts(): array
    {
        return [
            'schedule_date' => 'date',
            'important_flag' => 'boolean',
        ];
    }
}
