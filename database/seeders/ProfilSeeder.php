<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profil; // <-- Import model Profil
use Faker\Factory as Faker; // <-- Import Faker

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inisialisasi Faker
        $faker = Faker::create('id_ID');
        // Buat 100 data Profil
        foreach (range(1, 100) as $index) {
            Profil::create([
                // Kita tambahkan $index di nama desa agar unik
                'nama_desa' => 'Desa ' . $faker->lastName() . ' ' . $index,
                'kecamatan' => 'Kecamatan ' . $faker->city(),
                'kabupaten' => 'Kabupaten ' . $faker->city(),
                'provinsi' => $faker->state(),
                'alamat_kantor' => $faker->address(),
                'email' => $faker->unique()->companyEmail(), // Pastikan email unik
                'telepon' => $faker->phoneNumber(),
                'visi' => $faker->realText(150), // Buat kalimat Visi
                'misi' => $faker->realText(400), // Buat paragraf Misi
            ]);
        }
    }
}
