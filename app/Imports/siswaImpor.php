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
        // Define the valid ENUM values for 'tingkat' as strings
        $validTingkatValues = ['10', '11', '12']; // Adjust based on your actual ENUM values


        foreach ($collection as $c) {
            // Find the Jurusan by 'id_jurusan'
            $jurusan = Jurusan::where('id_jurusan', $c['id_jurusan'])->first();
            $jurusanId = $jurusan ? $jurusan->id_jurusan : null;

            $nik_ayah = $c ? $c['nik_ayah'] : null;
            $nik_ibu = $c ? $c['nik_ibu'] : null;
            $nik_wali = $c ? $c['nik_wali'] : null;

            // Check if the Jurusan ID exists and is valid
            if ($jurusanId) {
                // Validate 'tingkat' against ENUM values
                $tingkatValue = (string) $c['tingkat']; // Convert to string for comparison

                if (in_array($tingkatValue, $validTingkatValues)) {
                    // Check if the Kelas already exists
                    $kelas = Kelas::where('nomor_kelas', $c['nomor_kelas'])
                                ->where('id_jurusan', $jurusanId)
                                ->where('tingkat', $tingkatValue)
                                ->first();

                    if (!$kelas) {
                        return redirect()->back()->with('failed', 'Kelas Tidak Ditemukan: ' . $c['tingkat'] . ' ' . $c['id_jurusan'] . ' ' . $c['nomor_kelas']);
                    }

                    // Check if the User already exists
                    $user = User::where('email', $c['email'])->where('role', "siswa")->first();
                    if ($user) {
                        // Update existing User
                        $user->update([
                            'name' => $c['name'],
                        ]);
                    } else {
                        // Create new User
                        $user = User::create([
                            'name' => $c['name'],
                            'email' => $c['email'],
                            'password' => password_hash("12345678", PASSWORD_DEFAULT),
                            'role' => 'siswa'
                        ]);
                    }

                    // Check if the Siswa already exists
                    $siswa = Siswa::where('nis', "00" .  $c["nis"])->first();
                    if ($siswa) {
                        // Update existing Siswa
                        $siswa->update([
                            'id_user' => $user->id,
                            'id_kelas' => $kelas->id_kelas,
                            'jenis_kelamin' => $c['jenis_kelamin'],
                            'nik_ayah' => $nik_ayah,
                            'nik_ibu' => $nik_ibu,
                            'nik_wali' => $nik_wali,
                        ]);
                    } else {
                        // Create new Siswa
                        Siswa::insert([
                            'nis' => "00" . $c["nis"],
                            'nisn' => "00" . $c["nisn"],
                            'id_user' => $user->id,
                            'id_kelas' => $kelas->id_kelas,
                            'jenis_kelamin' => $c['jenis_kelamin'],
                            'nik_ayah' => $nik_ayah,
                            'nik_ibu' => $nik_ibu,
                            'nik_wali' => $nik_wali,
                        ]);
                    }
                    // User and Siswa creation/update logic remains the same...
                } else {
                    // Handle invalid 'tingkat' values
                    return redirect()->back()->with('failed', 'Invalid tingkat value: ' . $tingkatValue);
                }
            } else {
                // Handle cases where Jurusan does not exist
                return redirect()->back()->with('failed', 'Jurusan not found for ID: ' . $c['id_jurusan']);
            }
        }
    }
}
