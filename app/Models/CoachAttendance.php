<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'coach_id',
        'date',
        'status',
        'notes',
    ];

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }
}
