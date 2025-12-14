<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // 1. Daftar Pilihan Kata untuk Judul (Agar bervariasi)
        $jenisKegiatan = [
            'Seminar', 'Workshop', 'Pelatihan', 'Konferensi', 
            'Rapat Koordinasi', 'Simposium', 'Festival', 'Pameran', 
            'Sosialisasi', 'Diskusi Panel'
        ];

        $topik = [
            'Teknologi Informasi', 'Kesehatan Masyarakat', 'Pendidikan Karakter',
            'Manajemen Bisnis', 'Ekonomi Kreatif', 'Lingkungan Hidup',
            'Pengembangan UMKM', 'Strategi Pemasaran Digital', 'Keamanan Siber',
            'Kepemimpinan', 'Tata Kota', 'Pertanian Modern'
        ];

        // 2. Daftar Template Kalimat untuk Deskripsi
        $kalimatPembuka = [
            'Acara ini bertujuan untuk meningkatkan pemahaman mengenai',
            'Sebuah forum diskusi mendalam yang membahas tentang',
            'Kegiatan rutin tahunan yang berfokus pada pengembangan',
            'Sesi interaktif yang dirancang untuk para profesional di bidang',
        ];

        foreach (range(1, 100) as $index) {
            
            // Logika Tanggal (Tetap dipertahankan)
            $startDate = $faker->dateTimeBetween('-1 month', '+3 months');
            $endDate = (clone $startDate)->modify('+' . rand(1, 5) . ' days');

            // Membuat Judul Random: "Seminar" + "Teknologi Informasi"
            $judul = $faker->randomElement($jenisKegiatan) . ' Nasional: ' . $faker->randomElement($topik);

            // Membuat Deskripsi yang lebih nyata
            $deskripsi = $faker->randomElement($kalimatPembuka) . ' ' . strtolower($faker->randomElement($topik)) . 
                         '. Dihadiri oleh berbagai narasumber ahli dan praktisi. ' .
                         'Kegiatan ini diharapkan dapat memberikan wawasan baru bagi peserta.';

            Agenda::create([
                'judul'           => $judul,
                'lokasi'          => $faker->address(), // Alamat Indonesia (bawaan Faker id_ID)
                'tanggal_mulai'   => $startDate,
                'tanggal_selesai' => $endDate,
                'penyelenggara'   => $faker->company(), // Nama PT/CV (bawaan Faker id_ID)
                'deskripsi'       => $deskripsi,
            ]);
        }
    }
}