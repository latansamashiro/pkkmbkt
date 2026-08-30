<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'topic_type',
        'category',
        'trainer',
        'status',
        'file_link',
        'thumbnail_link',
        'download_link',
        'created_by_id',
        'updated_by_id',
        // 'topic_type', // opsional: hapus kalau memang sudah tidak dipakai
    ];
}
