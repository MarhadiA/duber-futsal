<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan lokal Indonesia

        for ($i = 1; $i <= 50; $i++) {
            $birthYear = $faker->numberBetween(2010, 2018); // Contoh rentang tahun lahir anak/remaja

            Student::create([
                'name'         => $faker->name,
                'birth_place'  => $faker->city,
                'birth_date'   => $faker->date('Y-m-d', "{$birthYear}-12-31"),
                'birth_year'   => $birthYear,
                'parent_name'  => $faker->name,
                'parent_phone' => $faker->phoneNumber,
                // Menggunakan avatar acak dari DiceBear (gratis dan stabil)
                'photo'        => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Student' . $i,
                'status'       => 'active',
            ]);
        }
    }
}
