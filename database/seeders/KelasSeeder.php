<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kompetensi = [
            'RPL' => 'Rekayasa Perangkat Lunak',
            'TKJ' => 'Teknik Komputer dan Jaringan',
            'MM' => 'Multimedia',
            'SIJA' => 'Sistem Informasi Jaringan dan Aplikasi',
        ];

        $tingkat = ['X', 'XI', 'XII'];
        $id = 1;

        foreach ($tingkat as $t) {
            foreach ($kompetensi as $kode => $nama) {
                for ($i = 1; $i <= 2; $i++) {
                    DB::table('kelas')->insert([
                        'id_kelas' => $id++,
                        'nama_kelas' => $t . ' ' . $kode . ' ' . $i,
                        'kompetensi_keahlian' => $nama,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}