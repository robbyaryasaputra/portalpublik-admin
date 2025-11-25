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

        foreach (range(1, 100) as $index) {
            
            // Logika agar tanggal selesai selalu setelah tanggal mulai
            // Agenda dibuat random antara bulan lalu sampai 3 bulan ke depan
            $startDate = $faker->dateTimeBetween('-1 month', '+3 months');
            
            // Durasi acara 1 sampai 5 hari
            $endDate = (clone $startDate)->modify('+' . rand(1, 5) . ' days');

            Agenda::create([
                'judul'           => 'Agenda: ' . $faker->sentence(4),
                'lokasi'          => $faker->address(),
                'tanggal_mulai'   => $startDate,
                'tanggal_selesai' => $endDate,
                'penyelenggara'   => $faker->company(),
                'deskripsi'       => $faker->paragraph(3),
            ]);
        }
    }
}