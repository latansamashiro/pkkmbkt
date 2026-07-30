<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceTemplate extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}