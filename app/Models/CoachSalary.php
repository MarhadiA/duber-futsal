<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachSalary extends Model
{
    use HasFactory;

    protected $fillable = ['coach_id', 'month', 'total_sessions', 'fee_per_session', 'total_salary', 'status'];

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }
}
