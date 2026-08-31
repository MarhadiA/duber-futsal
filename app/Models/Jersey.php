<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jersey extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'height',
        'weight',
        'size',
        'jersey_photo',
        'price',
        'paid_amount',
        'status',
        'notes'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
