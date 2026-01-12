<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SppSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('spp')->insert([
            [
                'id_spp' => 1,
                'tahun' => 2024,
                'nominal' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_spp' => 2,
                'tahun' => 2025,
                'nominal' => 175000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_spp' => 3,
                'tahun' => 2026,
                'nominal' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}