<?php

namespace Database\Seeders;

use App\Models\koordinat_sekolah;
use App\Models\waktu_absen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class waktu_koodinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        waktu_absen::insert([
            'id_waktu_absen' => 1,
            'mulai_absen' => '06:00:00',
            'batas_absen' => '07:00:00',
            'mulai_pulang' => '15:00:00',
            'batas_pulang' => '17:00:00'
        ]);

        koordinat_sekolah::insert([
            'id_koordinat_sekolah' => '1',
            'titik_koordinat' => '-6.89033536888645, 107.55833009635417',
            'radius' => 200.00
        ]);
    }
}
