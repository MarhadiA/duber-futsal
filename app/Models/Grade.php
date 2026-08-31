<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'aspect',
        'score',
        'notes',
        'period',
        'start_date',
        'end_date',
        'coach_name',
    ];
}
