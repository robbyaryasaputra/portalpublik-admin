<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import model User
use Faker\Factory as Faker; // <-- Import Faker

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        // Inisialisasi Faker
        $faker = Faker::create('id_ID');

        // 2. Buat 100 User acak
        // Kita ubah perulangan dari 'range(1, 10)' menjadi 'range(1, 100)'
        foreach (range(1, 100) as $index) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => 'password123',
                'role' => 'admin', // Semua password sama, akan di-hash
            ]);
        }
    }
}
