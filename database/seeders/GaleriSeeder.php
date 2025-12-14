<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use Faker\Factory as Faker;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // 1. Daftar Kegiatan untuk Judul Album
        $jenisKegiatan = [
            'Gotong Royong', 'Musyawarah Desa', 'Penyaluran BLT', 
            'Posyandu Balita', 'Senam Pagi Bersama', 'Rapat Koordinasi',
            'Kunjungan Bupati', 'Pelatihan UMKM', 'Panen Raya',
            'Peringatan HUT RI', 'Perbaikan Jalan', 'Sosialisasi Kesehatan'
        ];

        // 2. Keterangan Tambahan untuk Judul
        $konteks = [
            '2023', '2024', 'di Balai Desa', 'Tingkat Kecamatan',
            'Bersama Warga', 'Tahap 1', 'Edisi Spesial', 'Akhir Tahun'
        ];

        // 3. Template Kalimat untuk Deskripsi
        $awalKalimat = [
            'Berikut adalah dokumentasi keseruan acara',
            'Momen-momen penting yang tertangkap kamera saat kegiatan',
            'Dokumentasi resmi dari pelaksanaan',
            'Arsip foto kegiatan'
        ];

        foreach (range(1, 100) as $index) {
            
            // Membuat Judul: "Gotong Royong Bersama Warga" atau "Rapat Koordinasi 2024"
            $kegiatanTerpilih = $faker->randomElement($jenisKegiatan);
            $judul = "Dokumentasi $kegiatanTerpilih " . $faker->randomElement($konteks);

            // Membuat Deskripsi yang nyambung dengan judul
            $deskripsi = $faker->randomElement($awalKalimat) . ' ' . strtolower($kegiatanTerpilih) . 
                         ' yang dilaksanakan pada tanggal ' . $faker->date('d F Y') . '. ' .
                         'Acara berjalan dengan lancar dan dihadiri oleh banyak peserta.';

            Galeri::create([
                'judul'     => $judul,
                'deskripsi' => $deskripsi,
            ]);
        }
    }
}