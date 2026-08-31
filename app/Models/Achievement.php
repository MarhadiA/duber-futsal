<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'photos',
    ];

    // Mengubah format kolom photos menjadi array otomatis
    protected $casts = [
        'photos' => 'array',
    ];
}
