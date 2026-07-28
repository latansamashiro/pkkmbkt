<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'informations';

    protected $fillable = [
        'title',
        'category',
        'status',
        'important_flag',
        'description',
        'created_by_id',
        'updated_by_id',
    ];

    protected function casts(): array
    {
        return [
            'important_flag' => 'boolean',
        ];
    }
}