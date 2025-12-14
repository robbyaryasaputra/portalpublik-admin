<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBerita;
use Illuminate\Support\Str;
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
        $faker = Faker::create('id_ID');

        // 1. Daftar Topik Berita (Agar tidak Lorem Ipsum)
        $topik = [
            'Politik', 'Ekonomi', 'Olahraga', 'Teknologi', 'Hiburan', 
            'Otomotif', 'Kesehatan', 'Kuliner', 'Wisata', 'Edukasi',
            'Hukum', 'Kriminal', 'Properti', 'Sains', 'Lingkungan',
            'Sejarah', 'Budaya', 'Karir', 'Finansial', 'Parenting'
        ];

        // 2. Jenis/Cakupan Berita (Untuk variasi agar bisa mencapai 100 data unik)
        $cakupan = [
            'Nasional', 'Internasional', 'Regional', 'Terkini', 'Populer', 
            'Pilihan', 'Investigasi', 'Viral', 'Eksklusif', 'Akhir Pekan',
            'Utama', 'Sore', 'Pagi', 'Mendalam', 'Opini'
        ];

        // 3. Template Deskripsi
        $templateDeskripsi = [
            'Menyajikan informasi terbaru dan terpercaya seputar dunia',
            'Kumpulan berita pilihan yang sedang hangat diperbincangkan mengenai',
            'Ulasan mendalam dan analisis tajam terkait isu',
            'Update harian untuk menambah wawasan Anda di bidang'
        ];

        // Kita akan mencoba membuat kombinasi unik
        // Karena kita butuh 100, kita harus pastikan kombinasinya cukup
        $count = 0;
        
        // Loop ini akan terus berjalan sampai kita mendapatkan 100 data unik
        // atau sampai kombinasi habis.
        foreach ($topik as $t) {
            foreach ($cakupan as $c) {
                if ($count >= 100) break 2; // Stop jika sudah 100 data

                $namaKategori = "$t $c"; // Contoh: "Politik Nasional", "Teknologi Terkini"

                KategoriBerita::create([
                    'nama'      => $namaKategori,
                    'slug'      => Str::slug($namaKategori),
                    // Deskripsi: "Menyajikan informasi... seputar Politik Nasional."
                    'deskripsi' => $faker->randomElement($templateDeskripsi) . ' ' . $namaKategori . '.',
                ]);

                $count++;
            }
        }
    }
}