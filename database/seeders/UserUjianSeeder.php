<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserUjian;
use Illuminate\Support\Facades\Hash;

class UserUjianSeeder extends Seeder
{
    public function run(): void
    {
        UserUjian::create([
            'nama' => 'Rizki Wahyu',
            'no_peserta' => 'UJN001',
            'password' => Hash::make('123456'),
            'nis' => '12345',
            'kelas' => 'XII RPL 1',
            'ruangan' => 'Lab 1',
            'sesi' => '1',
            'is_active' => true,
            'is_login' => false,
        ]);

        UserUjian::create([
            'nama' => 'Budi Santoso',
            'no_peserta' => 'UJN002',
            'password' => Hash::make('123456'),
            'kelas' => 'XII RPL 1',
            'ruangan' => 'Lab 1',
            'sesi' => '1',
            'is_active' => true,
        ]);
    }
}