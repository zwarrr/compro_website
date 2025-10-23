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
            ['nama' => 'Admin', 'email' => 'admin@compro.com', 'password' => Hash::make('admin')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
