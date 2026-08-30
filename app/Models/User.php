<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Actions\Audit\AuditTrail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Hidden(['password', 'remember_token'])]
#[ObservedBy(AuditTrail::class)]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Field yang boleh diisi langsung lewat mass assignment (form/import).
     *
     * SENGAJA TIDAK termasuk: role_name, status, created_by_id, updated_by_id.
     * Field-field ini menentukan hak akses & jejak audit, jadi cuma boleh
     * di-set manual oleh controller lewat property assignment
     * (mis. $user->role_name = $role;), bukan lewat array request mentah.
     * Ini mencegah privilege escalation kalau suatu saat ada kode baru yang
     * teledor pakai User::create($request->all()).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_no',
        'faculty_name',
        'program_study_name',
        'gender',
        'npm',
        'advisor_type',
        'profile_picture',
        'certificate_link',
        'pending_group_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value !== null ? mb_strtoupper($value) : $value;
    }

    public function setFacultyNameAttribute($value)
    {
        $this->attributes['faculty_name'] = $value !== null ? mb_strtoupper($value) : $value;
    }

    public function setProgramStudyNameAttribute($value)
    {
        $this->attributes['program_study_name'] = $value !== null ? mb_strtoupper($value) : $value;
    }
}