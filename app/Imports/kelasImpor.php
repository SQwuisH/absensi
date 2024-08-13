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

class kelasImpor implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $c)
        {
            $jurusan = jurusan::where('id_jurusan', $c['id_jurusan'])->first();
            $j_id = $jurusan ? $jurusan->id_jurusan : null;

            if($j_id)
            {
                $kelas = kelas::where('nomor_kelas', $c['nomor_kelas'])->where('id_jurusan', $j_id)->first();

                if(!$kelas)
                {
                    $kelas = kelas::create([
                        'tingkat' => $c['tingkat'],
                        'id_jurusan' => $j_id,
                        'nomor_kelas' => $c['nomor_kelas']
                    ]);
                }

                $user = User::where('email', $c['email'])->first();
                if($user)
                {
                    $user->update([
                        'name' => $c['nama']
                    ]);
                }
                else
                {
                    $user = User::create([
                        'name' => $c['nama'],
                        'email' => $c['email'],
                        'password' => password_hash("12345678", PASSWORD_DEFAULT),
                        'role' => 'siswa'
                    ]);
                }

                $siswa = siswa::where('nis', $c['nis'])->first();
                if($siswa)
                {
                    $siswa->update([
                        'id_kelas' => $kelas->id_kelas,
                        'jenis_kelamin' => $c['jenis_kelamin'],
                        'nisn' => $c['nisn']
                    ]);
                }
                else
                {
                    siswa::insert([
                        'nis' => $c['nis'],
                        'id_user' => $user->id,
                        'id_kelas' => $kelas->id_kelas,
                        'nik' => $c['nik'],
                        'jenis_kelamin' => $c['jenis_kelamin'],
                        'nisn' => $c['nisn']
                    ]);
                }
            }
            else
            {

            }
        }
    }
}
