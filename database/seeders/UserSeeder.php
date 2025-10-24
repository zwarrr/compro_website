<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua user terlebih dahulu untuk memastikan fresh data
        User::truncate();

        // Buat hanya 1 user admin
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@compro.com',
            'password' => Hash::make('admin'), // Password: admin
        ]);

        $this->command->info('User seeder completed successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Email: admin@compro.com');
        $this->command->info('Password: admin');
    }
}
