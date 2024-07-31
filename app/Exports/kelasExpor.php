<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class kelasExpor implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        return ([
            ['tingkat', 'nama jurusan', 'nomor kelas', 'nis','nisn', 'nama', 'email', 'jenis_kelamin'],
            ['10/11/12', '', '', '', '', '', '', 'laki laki/perempuan']
        ]);
    }
}
