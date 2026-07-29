<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Actions\Audit\AuditTrail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Guarded(['id'])]
#[Hidden(['password', 'remember_token'])]
#[ObservedBy(AuditTrail::class)]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

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

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value !== null ? mb_strtoupper($value) : $value,
        );
    }

    protected function facultyName(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value !== null ? mb_strtoupper($value) : $value,
        );
    }

    protected function programStudyName(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value !== null ? mb_strtoupper($value) : $value,
        );
    }
}