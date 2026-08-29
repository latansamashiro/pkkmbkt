<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicProgress extends Model
{
    protected $table = 'topic_progress';

    protected $fillable = [
        'student_id',
        'topic_id',
        'percent',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
