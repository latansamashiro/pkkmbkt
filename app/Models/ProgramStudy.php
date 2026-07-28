<?php

namespace App\Models;

use App\Actions\Audit\AuditTrail;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Guarded(['id'])]
#[ObservedBy(AuditTrail::class)]
#[Table('program_study')]
class ProgramStudy extends Model
{
    use SoftDeletes;
}
