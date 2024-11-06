<?php

namespace Database\Seeders;

use App\Models\kelas;
use Illuminate\Database\Seeder;
use App\Models\wali;
use App\Models\User;

class WaliKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas =  kelas::all();
        $jk = ['laki laki', 'perempuan'];

        foreach ($kelas as $k) {
            if ($k->id_kelas == 9) {
                $k->where('id_kelas', $k->id_kelas)->update([
                    'nip' => 198005052022011001
                ]);
            }
            else if($k->id_kelas ==  23)
            {
                $k->where('id_kelas', $k->id_kelas)->update([
                    'nip' => 198107062022021002
                ]);
            }
            else if($k->id_kelas ==  37)
            {
                $k->where('id_kelas', $k->id_kelas)->update([
                    'nip' => 198209072022031003
                ]);
            }
            else {
                $random = rand(0, 1);
                $nip = rand(100000000000, 999999999999);
                $nuptk = rand(100000000000, 999999999999);

                $user = user::create([
                    'name' => fake()->name(),
                    'email' => 'wali' . strtoupper("$k->tingkat$k->id_jurusan$k->nomor_kelas") . '@gmail.com',
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'wali',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                wali::insert([
                    'nip' => $nip,
                    'id_user' => $user->id,
                    'jenis_kelamin' => $jk[$random],
                    'nuptk' => $nuptk,
                ]);

                kelas::where('id_kelas', $k->id_kelas)->update([
                    'nip' => $nip
                ]);
            }
        }
    }
}
