<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Support\Str;
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
        $faker = Faker::create('id_ID');

        // 1. Ambil SEMUA ID kategori yang ada di database
        $kategoriIds = KategoriBerita::pluck('kategori_id')->all(); // Pastikan kolom primary key-nya 'id'

        // 2. Validasi Kategori
        if (empty($kategoriIds)) {
            $this->command->error('Tidak ada kategori berita. Jalankan KategoriBeritaSeeder terlebih dahulu.');
            return;
        }

        // --- DATA DUMMY UNTUK MENYUSUN KALIMAT BERITA ---
        
        $subjek = ['Pemerintah', 'Dinas Pariwisata', 'Warga Setempat', 'Polres', 'Komunitas Pemuda', 'Gubernur', 'Pelaku UMKM', 'Tim Relawan'];
        
        $predikat = ['Resmi Membuka', 'Menggelar', 'Menolak Rencana', 'Berhasil Mengungkap', 'Mengapresiasi', 'Mengecam Aksi', 'Meluncurkan Program', 'Menenangkan'];
        
        $objek = ['Festival Kuliner', 'Pembangunan Jembatan', 'Sosialisasi Kesehatan', 'Turnamen Sepakbola', 'Pameran Teknologi', 'Proyek Jalan Tol', 'Bantuan Sosial', 'Lomba Kebersihan'];
        
        $keterangan = ['Tingkat Nasional', 'di Alun-alun Kota', 'Secara Virtual', 'Demi Kemajuan Ekonomi', 'Pasca Pandemi', 'Tahun 2024', 'dengan Meriah', 'untuk Masa Depan'];

        // Template Paragraf Awal
        $introTemplates = [
            'Suasana meriah menyelimuti acara yang berlangsung pagi ini.',
            'Hal ini menjadi sorotan utama masyarakat dalam beberapa hari terakhir.',
            'Keputusan ini diambil setelah melalui proses musyawarah yang panjang.',
            'Antusiasme warga terlihat sangat tinggi sejak acara dimulai pukul 08.00 WIB.',
        ];

        // ------------------------------------------------

        foreach (range(1, 100) as $index) {
            
            // 3. Merakit Judul agar Masuk Akal (Subjek + Predikat + Objek + Keterangan)
            $judul = $faker->randomElement($subjek) . ' ' . 
                     $faker->randomElement($predikat) . ' ' . 
                     $faker->randomElement($objek) . ' ' . 
                     $faker->randomElement($keterangan);

            // 4. Membuat Isi Berita (Dateline + Isi)
            // Contoh output: "BANDUNG - Suasana meriah menyelimuti... "
            $kota = strtoupper($faker->city());
            $paragraf1 = $kota . ' - ' . $faker->randomElement($introTemplates) . ' ' . $judul . '. ' . $faker->paragraph(3);
            $paragraf2 = 'Dalam sambutannya, ' . $faker->name() . ' selaku tokoh setempat menyampaikan apresiasinya. "' . $faker->sentence(10) . '" ujarnya kepada awak media.';
            $paragraf3 = 'Kegiatan ini diharapkan dapat memberikan dampak positif bagi ' . strtolower($faker->randomElement($subjek)) . ' dan masyarakat luas.';

            // Gabungkan jadi HTML
            $isiHtml = "<p>$paragraf1</p><p>$paragraf2</p><p>$paragraf3</p>";

            Berita::create([
                'kategori_id' => $faker->randomElement($kategoriIds),
                'judul'       => $judul,
                'slug'        => Str::slug($judul) . '-' . Str::random(5), // Tambah random string biar slug pasti unik
                'isi_html'    => $isiHtml,
                'penulis'     => $faker->name(), 
                'status'      => $faker->randomElement(['published', 'draft']),
                'terbit_at'   => $faker->dateTimeBetween('-1 year', 'now'),
                // Jika tabelmu punya kolom 'views' atau 'gambar', bisa ditambahkan di sini
                // 'views'    => rand(10, 5000),
            ]);
        }
    }
}