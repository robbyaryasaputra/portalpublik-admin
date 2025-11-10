<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\KategoriBerita; // <-- Penting
use Illuminate\Support\Str;
use Carbon\Carbon;
// Import Faker
use Faker\Factory as Faker;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inisialisasi Faker
        $faker = Faker::create('id_ID');

        // 1. Ambil SEMUA ID kategori yang ada di database
        //    (Yang baru saja dibuat oleh KategoriBeritaSeeder)
        $kategoriIds = KategoriBerita::pluck('kategori_id')->all();

        // 2. Jika tidak ada kategori, hentikan seeder
        if (empty($kategoriIds)) {
            $this->command->error('Tidak ada kategori berita. Jalankan KategoriBeritaSeeder terlebih dahulu.');
            return;
        }

        // 3. Buat 50 Berita Acak
        foreach (range(1, 50) as $index) {
            // Buat judul acak
            $judul = $faker->sentence(6); // 6 kata acak

            Berita::create([
                // Pilih satu ID kategori secara acak dari daftar $kategoriIds
                'kategori_id' => $faker->randomElement($kategoriIds),

                'judul'     => $judul,
                'slug'      => Str::slug($judul),

                // Buat 3 paragraf HTML acak
                'isi_html'  => '<p>' . $faker->paragraphs(3, true) . '</p>',

                'penulis'   => $faker->name(), // Nama orang acak

                // Status acak (published atau draft)
                'status'    => $faker->randomElement(['published', 'draft']),

                // Tanggal terbit acak dalam 1 tahun terakhir
                'terbit_at' => $faker->dateTimeBetween('-1 year', 'now')
            ]);
        }
    }
}
