<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga; // <-- Import model Warga
use Faker\Factory as Faker; // <-- Import Faker

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inisialisasi Faker
        // Kita gunakan 'id_ID' agar datanya terdengar Indonesia
        $faker = Faker::create('id_ID');

        // Buat 100 data Warga
        foreach (range(1, 100) as $index) {
            Warga::create([
                // no_ktp harus unik
                'no_ktp' => $faker->unique()->nik(),
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan' => $faker->jobTitle(),
                'telp' => $faker->phoneNumber(),
                // email harus unik
                'email' => $faker->unique()->safeEmail(),
            ]);
        }
    }
}
