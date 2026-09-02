<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    protected $fillable = [
        'role_name',
        'nama',
        'email',
        'password',
        'kelompok',
        'prodi',
        'advisor_type',
        'imported_by_id',
    ];

    public function importedBy()
    {
        return $this->belongsTo(User::class, 'imported_by_id');
    }
}
