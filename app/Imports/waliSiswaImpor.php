<?php

namespace App\Imports;

use App\Models\User;
use App\Models\wali;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class waliSiswaImpor implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
         foreach($collection as $c)
        {
            $wali = User::where('email', $c['email'])->first();
            if($wali)
            {
                $wali->update([
                    'name' => $c['nama'],
                    'role' => 'wali'
                ]);

                wali::updateOrInsert(
                    ['id' => $wali->id,
                    'nuptk' => $c['nuptk'],
                    'jenis_kelamin' => $c['jenis_kelamin'],
                    'nip' => $c['nip'],
                ]);
            }
            else
            {
                $user = User::create([
                    'name' => $c['nama'],
                    'email' => $c['email'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'wali'
                ]);

                wali::insert(
                    ['id' => $user->id,
                    'nuptk' => $c['nuptk'],
                    'jenis_kelamin' => $c['jenis_kelamin'],
                    'nip' => $c['nip'],
                ]);
            }
        }
    }
}
