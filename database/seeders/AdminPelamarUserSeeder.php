<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Penting: Pastikan ini di-import
use Illuminate\Support\Facades\Hash; // Penting: Pastikan ini di-import

class AdminPelamarUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@mail.com', // Email untuk admin
            'password' => Hash::make('passwordadmin'), // Password untuk admin
            'role' => 'admin',
        ]);

        // Buat user Pelamar
        User::create([
            'name' => 'Pelamar Contoh',
            'email' => 'pelamar@mail.com', // Email untuk pelamar
            'password' => Hash::make('passwordpelamar'), // Password untuk pelamar
            'role' => 'pelamar',
        ]);
    }
}