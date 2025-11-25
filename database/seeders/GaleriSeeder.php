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

        foreach (range(1, 100) as $index) {
            Galeri::create([
                'judul'     => $faker->words(3, true) . ' Activity',
                'deskripsi' => $faker->paragraph(2),
            ]);
        }
    }
}