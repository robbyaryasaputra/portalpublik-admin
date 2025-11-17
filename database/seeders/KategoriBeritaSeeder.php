<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriBerita;
use Illuminate\Support\Str;
// Import Faker
use Faker\Factory as Faker;

class KategoriBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inisialisasi Faker
        // Kita gunakan 'id_ID' agar datanya terdengar Indonesia
        $faker = Faker::create('id_ID');

        // Buat 10 Kategori Berita
        foreach (range(1, 100) as $index) {
            // Buat nama yang unik (misal: "Berita Olahraga", "Info Keuangan")
            // 'words(3, true)' = 3 kata, dikembalikan sebagai string
            $nama = 'Berita ' . $faker->unique()->words(2, true);

            KategoriBerita::create([
                'nama'      => $nama,
                'slug'      => Str::slug($nama),
                'deskripsi' => $faker->sentence(10) // Buat deskripsi acak 10 kata
            ]);
        }
    }
}
