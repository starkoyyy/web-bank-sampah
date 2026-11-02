<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Nasabah;
use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'nama' => 'Admin Bank Sampah',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Nasabah Contoh
        $nasabahUser = User::firstOrCreate(
            ['username' => 'nasabah'],
            [
                'nama' => 'Nasabah Contoh',
                'password' => Hash::make('nasabah123'),
                'role' => 'nasabah',
            ]
        );

        Nasabah::firstOrCreate(
            ['user_id' => $nasabahUser->id],
            [
                'alamat' => 'Jl. Merdeka No. 45',
                'jenis_kelamin' => 'Laki-laki',
                'total_saldo' => 50000,
            ]
        );

        // 3. Kategori Sampah Awal
        $kategoriList = [
            ['nama_kategori' => 'Plastik (Botol / Gelas)', 'harga_per_kg' => 3000],
            ['nama_kategori' => 'Kardus & Kertas', 'harga_per_kg' => 2000],
            ['nama_kategori' => 'Besi & Logam', 'harga_per_kg' => 5000],
            ['nama_kategori' => 'Botol Kaca', 'harga_per_kg' => 1500],
            ['nama_kategori' => 'Minyak Jelantah', 'harga_per_kg' => 6000],
        ];

        foreach ($kategoriList as $kat) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $kat['nama_kategori']],
                ['harga_per_kg' => $kat['harga_per_kg']]
            );
        }
    }
}
