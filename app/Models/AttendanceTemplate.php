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

    protected static function booted(): void
    {
        // Sesi yang sudah punya absensi ber-status "submitted" adalah arsip —
        // jam/tanggalnya tidak boleh diubah lagi, dan sesinya tidak boleh dihapus.
        static::updating(function (self $template) {
            if ($template->attendances()->where('status', 'submitted')->exists()) {
                abort(422, 'Sesi ini sudah punya absensi yang sudah disubmit dan tidak boleh diubah lagi.');
            }
        });

        static::deleting(function (self $template) {
            if ($template->attendances()->exists()) {
                abort(422, 'Sesi ini sudah punya data absensi dan tidak bisa dihapus.');
            }
        });
    }
}