<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'birth_place',
        'birth_date',
        'birth_year',
        'parent_name',
        'parent_phone',
        'photo',
        'status'
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relasi ke transaksi keuangan (Kas masuk & keluar)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function monthlyBills()
    {
        return $this->hasMany(MonthlyBill::class);
    }
    public function jerseys()
    {
        return $this->hasMany(Jersey::class);
    }
}
