<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function template()
    {
        return $this->belongsTo(AttendanceTemplate::class, 'attendance_template_id');
    }

    public function details()
    {
        return $this->hasMany(AttendanceDetail::class);
    }
}