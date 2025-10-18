<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        // Seeder harus dijalankan sesuai urutan karena ada foreign key dependencies
        $this->call([
            UserSeeder::class,
            ProfilePerusahaanSeeder::class,
            KategoriSeeder::class,          // Harus pertama karena dipakai oleh tabel lain
            LayananSeeder::class,           // Depends on Kategori
            GaleriSeeder::class,            // Depends on Kategori
            KaryawanSeeder::class,          // Depends on Kategori
            ClientSeeder::class,            // Depends on Kategori
            TestimoniSeeder::class,         // Independent
            FaqSeeder::class,               // Independent
            SocialMediaSeeder::class,       // Independent
            KontakSeeder::class,            // Independent
        ]);
    }
}

