<?php

namespace App\Imports;

use App\Models\jurusan;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class siswaImpor implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $c)
        {
            
        }
    }
}
