<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('petugas')->insert([
            [
                'id_petugas' => 1,
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'nama_petugas' => 'Administrator',
                'level' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_petugas' => 2,
                'username' => 'petugas1',
                'password' => Hash::make('petugas123'),
                'nama_petugas' => 'Petugas Keuangan 1',
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_petugas' => 3,
                'username' => 'petugas2',
                'password' => Hash::make('petugas123'),
                'nama_petugas' => 'Petugas Keuangan 2',
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
