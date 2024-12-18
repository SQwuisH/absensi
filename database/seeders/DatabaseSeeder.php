<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(JurusanSeeder::class);
        $this->call(KelasSeeder::class);

        $this->call(waktu_koodinatSeeder::class);

        $this->call(users::class);
        $this->call(WaliKelasSeeder::class);
        $this->call(waliSiswaSeeder::class);
        $this->call(SiswaSeeder::class);

        $this->call(absenSeed::class);
    }
}
