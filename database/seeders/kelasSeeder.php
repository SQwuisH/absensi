<?php

namespace Database\Seeders;

use App\Models\jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusan = jurusan::all();
        $tingkat1 = [10];
        $tingkat2 = [11, 12];
        $j1 = ['PPLG', 'TJKT', 'PM', 'MPLB', 'AKL', 'DKV'];
        $j2 = ['AK', 'BR', 'MLOG', 'MP', 'TKJ', 'RPL', 'MM'];
        $nomor_kelas = [1, 2];

        foreach ($tingkat1 as $t1) {
            foreach ($jurusan as $j) {
                if (in_array($j->id_jurusan, $j1)) {
                    foreach ($nomor_kelas as $no) {
                        Kelas::insert([
                            'id_jurusan' => $j->id_jurusan,
                            'nomor_kelas' => $no,
                            'tingkat' => $t1,
                        ]);
                    }
                }
            }
        }

        foreach ($tingkat2 as $t2) {
            foreach ($jurusan as $j) {
                if (in_array($j->id_jurusan, $j2)) {
                    foreach ($nomor_kelas as $no) {
                        Kelas::insert([
                            'id_jurusan' => $j->id_jurusan,
                            'nomor_kelas' => $no,
                            'tingkat' => $t2,
                        ]);
                    }
                }
            }
        }
    }
}
