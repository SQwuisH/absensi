<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::insert([
            'nis' => '0061748352',
            'id_user' => 2,
            'id_kelas' => 1,
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678901',
            'nik_ibu' => '2345678901234567',
        ]);

        Siswa::insert([
            'nis' => '0062894371',
            'id_user' => 3,
            'id_kelas' => 2,
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678902',
            'nik_ayah' => '3456789012345678',
        ]);

        Siswa::insert([
            'nis' => '0069584720',
            'id_user' => 4,
            'id_kelas' => 3,
            'jenis_kelamin' => 'perempuan',
            'nisn' => '0045678903',
            'nik_wali' => '1234567890123456',
        ]);

        Siswa::insert([
            'nis' => '0069537821',
            'id_user' => 12,
            'id_kelas' => 3,
            'jenis_kelamin' => 'laki laki',
            'nisn' => '00609129',
            'nik_ayah' => '3456789012345678',
        ]);

    }
}
