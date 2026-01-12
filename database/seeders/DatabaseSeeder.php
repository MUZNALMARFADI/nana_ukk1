<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SppSeeder::class,
            KelasSeeder::class,
            PetugasSeeder::class,
            SiswaSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}