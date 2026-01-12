<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $namaSiswa = [
            'Ahmad Rizki', 'Budi Santoso', 'Citra Dewi', 'Doni Pratama',
            'Eka Putri', 'Fajar Hidayat', 'Gina Lestari', 'Hendra Wijaya',
            'Indah Permata', 'Joko Susilo', 'Kartika Sari', 'Lukman Hakim',
            'Maya Anggraini', 'Nanda Prasetyo', 'Olivia Rahayu', 'Putra Mahendra',
            'Qori Amalia', 'Rudi Hartono', 'Siti Nurjanah', 'Taufik Rahman'
        ];

        for ($i = 1; $i <= 20; $i++) {
            DB::table('siswa')->insert([
                'nisn' => '99250' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'nis' => '2025' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama' => $namaSiswa[$i - 1],
                'id_kelas' => rand(1, 24),
                'alamat' => 'Jl. Pendidikan No. ' . $i . ', Jakarta',
                'no_telp' => '081234' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'id_spp' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}