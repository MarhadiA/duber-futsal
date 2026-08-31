<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat atau perbarui akun admin default
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Cek berdasarkan email ini
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'), // Password default
            ]
        );
    }
}
