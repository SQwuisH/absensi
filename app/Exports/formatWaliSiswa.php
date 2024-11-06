<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class formatWaliSiswa implements FromArray
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        return ([[ 'nik', 'email', 'nama', 'jenis_kelamin', 'alamat']]);
    }
}
