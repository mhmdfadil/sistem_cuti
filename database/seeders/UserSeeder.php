<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan user admin
        User::create([
            'nama' => 'Admin Sistem',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // pastikan password dienkripsi
            'email_verified_at' => now(),
            'role' => 'Admin',
            'status' => 'Active',
            'profile_picture' => 'default-admin.png', // Bisa menambahkan gambar default
        ]);

        // Menambahkan user Pegawai
        User::create([
            'nama' => 'Pegawai A',
            'email' => 'Pegawai@example.com',
            'password' => Hash::make('password123'), // pastikan password dienkripsi
            'email_verified_at' => now(),
            'role' => 'Pegawai',
            'status' => 'Active',
            'profile_picture' => 'default-pegawai.png', // Bisa menambahkan gambar default
        ]);

        // Menambahkan user lainnya, bisa menambahkan lebih banyak lagi sesuai kebutuhan
        User::create([
            'nama' => 'Pegawai B',
            'email' => 'Pegawai2@example.com',
            'password' => Hash::make('password123'), // pastikan password dienkripsi
            'email_verified_at' => now(),
            'role' => 'Pegawai',
            'status' => 'Inactive',
            'profile_picture' => 'default-pegawai2.png', // Bisa menambahkan gambar default
        ]);
    }
}
