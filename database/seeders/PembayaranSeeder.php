<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $id = 1;
        for ($siswa = 1; $siswa <= 5; $siswa++) {
            $nisn = '99250' . str_pad($siswa, 5, '0', STR_PAD_LEFT);
            
            for ($b = 0; $b < 3; $b++) {
                DB::table('pembayaran')->insert([
                    'id_pembayaran' => $id++,
                    'id_petugas' => rand(2, 3),
                    'nisn' => $nisn,
                    'tgl_bayar' => now()->subMonths(2 - $b),
                    'bulan_dibayar' => $bulan[$b],
                    'tahun_dibayar' => '2025',
                    'id_spp' => 2,
                    'jumlah_bayar' => 175000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}