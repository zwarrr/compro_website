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
        $users = [
            ['nama' => 'Admin Utama', 'email' => 'admin@compro.com', 'password' => Hash::make('admin123')],
            ['nama' => 'Budi Santoso', 'email' => 'budi@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Siti Nurhaliza', 'email' => 'siti@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Ahmad Fadli', 'email' => 'ahmad@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Dewi Lestari', 'email' => 'dewi@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Rudi Hartono', 'email' => 'rudi@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Maya Putri', 'email' => 'maya@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Andi Wijaya', 'email' => 'andi@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Linda Sari', 'email' => 'linda@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Hendra Gunawan', 'email' => 'hendra@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Rina Kusuma', 'email' => 'rina@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Toni Setiawan', 'email' => 'toni@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Indah Permata', 'email' => 'indah@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Dedi Kurniawan', 'email' => 'dedi@compro.com', 'password' => Hash::make('password123')],
            ['nama' => 'Nur Azizah', 'email' => 'azizah@compro.com', 'password' => Hash::make('password123')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
