<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'id' => '1',
            'id_user' => 'dev01',
            'name' => 'dev test',
            'email' => 'devtest@gmail.com',
            'password' => Hash::make('devtest'),
            'level' => 'dev'
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'id_user' => 'siswa01',
            'name' => 'siswa test',
            'email' => 'siswatest@gmail.com',
            'password' => Hash::make('siswatest'),
            'level' => 'siswa'
        ]);

        DB::table('users')->insert([
            'id' => '3',
            'id_user' => 'guru01',
            'name' => 'guru test',
            'email' => 'gurutest@gmail.com',
            'password' => Hash::make('gurutest'),
            'level' => 'guru'
        ]);

        DB::table('users')->insert([
            'id' => '4',
            'id_user' => 'admin01',
            'name' => 'admin test',
            'email' => 'admintest@gmail.com',
            'password' => Hash::make('admintest'),
            'level' => 'admin'
        ]);

        DB::table('users')->insert([
            'id' => '5',
            'id_user' => 'kepsek01',
            'name' => 'kepsek test',
            'email' => 'kepsektest@gmail.com',
            'password' => Hash::make('kepsektest'),
            'level' => 'kepsek'
        ]);
    }
}
