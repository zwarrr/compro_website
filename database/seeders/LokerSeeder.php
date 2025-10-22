<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Loker;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $pendidikanOptions = ['SMA', 'D3', 'S1', 'S2'];

        for ($i = 1; $i <= 10; $i++) {
            $kode = 'LOKER-' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $gajiAwal = $faker->numberBetween(3000000, 7000000);
            $gajiAkhir = $gajiAwal + $faker->numberBetween(1000000, 8000000);
            Loker::create([
                'kode_loker' => $kode,
                'posisi' => $faker->jobTitle(),
                'perusahaan' => $faker->company(),
                'lokasi' => $faker->city(),
                'deskripsi' => $faker->sentence(12),
                'gaji_awal' => $gajiAwal,
                'gaji_akhir' => $gajiAkhir,
                'pengalaman' => $faker->numberBetween(0,5) . ' tahun',
                'pendidikan' => $faker->randomElement($pendidikanOptions),
                'status' => $faker->randomElement(['aktif','aktif','aktif','tidak aktif']),
            ]);
        }
    }
}
