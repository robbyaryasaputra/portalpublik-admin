<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profil;
use Faker\Factory as Faker;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Bank Kata untuk Nama Desa (Agar terdengar seperti nama tempat)
        $prefixDesa = ['Suka', 'Mekar', 'Cia', 'Bojong', 'Tanja', 'Wana', 'Pura', 'Jaya', 'Sumber', 'Tirta'];
        $suffixDesa = ['Maju', 'Sari', 'Wangi', 'Bakti', 'Raya', 'Mulya', 'Harapan', 'Makmur', 'Jaya', 'Abadi'];

        // 2. Bank Kalimat Visi (Cita-cita Desa)
        $daftarVisi = [
            'Terwujudnya desa yang mandiri, sejahtera, dan berakhlak mulia.',
            'Mewujudkan pelayanan publik yang prima menuju desa digital yang cerdas.',
            'Menjadi desa agrowisata yang unggul dan berdaya saing tinggi.',
            'Terciptanya tata kelola pemerintahan yang transparan dan akuntabel.',
            'Membangun masyarakat yang gotong royong, aman, dan damai.'
        ];

        // 3. Bank Kalimat Misi (Langkah-langkah)
        $daftarMisi = [
            'Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan.',
            'Mengembangkan potensi ekonomi lokal berbasis kerakyatan.',
            'Meningkatkan pembangunan infrastruktur desa yang merata.',
            'Mewujudkan pemerintahan desa yang bersih, transparan, dan melayani.',
            'Melestarikan nilai-nilai budaya dan kearifan lokal.',
            'Meningkatkan derajat kesehatan masyarakat dan kebersihan lingkungan.',
            'Memperkuat keamanan dan ketertiban masyarakat secara partisipatif.'
        ];

        foreach (range(1, 100) as $index) {
            
            // Membuat Nama Desa: Gabungan Prefix + Suffix (Contoh: "Sukamaju", "Mekarsari")
            $namaDesa = $faker->randomElement($prefixDesa) . strtolower($faker->randomElement($suffixDesa));

            // Membuat Misi: Mengambil 3 sampai 5 poin misi secara acak lalu digabung
            $misiTerpilih = $faker->randomElements($daftarMisi, rand(3, 5));
            // Format misi menjadi list angka (1. xxx 2. xxx)
            $misiText = "";
            foreach ($misiTerpilih as $key => $misi) {
                $nomor = $key + 1;
                $misiText .= "{$nomor}. {$misi}\n";
            }

            Profil::create([
                // Nama Desa lebih realistis daripada menggunakan lastName
                'nama_desa'     => 'Desa ' . $namaDesa, 
                
                // Menggunakan citySuffix (Sari, Baru, dll) atau nama jalan agar tidak selalu "Kecamatan Kota X"
                'kecamatan'     => 'Kecamatan ' . $faker->streetName(), 
                
                'kabupaten'     => $faker->city(), // Contoh: Kota Bandung / Kab. Bandung
                'provinsi'      => $faker->state(),
                'alamat_kantor' => $faker->address(),
                'email'         => 'admin@' . strtolower($namaDesa) . '.desa.id', // Email terlihat resmi
                'telepon'       => $faker->phoneNumber(),
                
                // Visi & Misi Realistis
                'visi'          => $faker->randomElement($daftarVisi),
                'misi'          => $misiText,
            ]);
        }
    }
}