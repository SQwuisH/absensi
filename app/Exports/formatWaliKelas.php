<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class formatWaliKelas implements FromArray, WithHeadingRow
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        return ([
            ['nama', 'email', 'nuptk', 'nip', 'jenis_kelamin'],
            ['', '', '', '', 'laki laki/perempuan']
        ]);
    }
}
