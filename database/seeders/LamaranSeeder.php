<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Lamaran;
use App\Models\Loker;
use Illuminate\Support\Str;

class LamaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $lokers = Loker::all();
        if ($lokers->count() == 0) return;

        $statusOptions = ['Diajukan','Diterima','Ditolak','Dikirim'];

        // create between 5-30 lamaran per loker
        foreach ($lokers as $loker) {
            $count = $faker->numberBetween(5, 30);
            for ($i = 0; $i < $count; $i++) {
                $kode = 'LAM-' . strtoupper(Str::random(6));
                Lamaran::create([
                    'loker_id' => $loker->id_loker,
                    'kode_lamaran' => $kode,
                    'nama_lengkap' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'resume' => null,
                    'pesan' => $faker->paragraph(),
                    'status' => $faker->randomElement($statusOptions),
                    'catatan_hrd' => $faker->optional()->sentence(),
                    'tanggal_interview' => $faker->optional()->dateTimeBetween('-1 months', '+2 months'),
                ]);
            }
        }
    }
}
