<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class formatSiswa implements FromArray
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        return ([
            ['tingkat', 'id_jurusan', 'nomor_kelas', 'nis', 'nisn', 'nik_ayah', 'nik_ibu', 'nik_wali', 'nama', 'email', 'jenis_kelamin'],
            ['10/11/12', '', '', '', '', '', '', '', '', '', 'laki laki/perempuan']
        ]);
    }
}
