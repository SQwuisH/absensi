<?php

namespace Database\Seeders;

use App\Models\siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\wali;
use App\Models\wali_siswa;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // OPERATOR
        User::create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        wali::insert([
            'nip' => '11111111111',
            'id_user' => 1,
            'jenis_kelamin' => 'laki laki',
            'nuptk' => '11111111111',
        ]);

        // KESISWAAN
        User::create([
            'name' => 'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        wali::insert([
            'nip' => '22222222222',
            'id_user' => 2,
            'jenis_kelamin' => 'laki laki',
            'nuptk' => '22222222222',
        ]);

        // WALI KELAS
        User::create([
            'name' => 'Engkus Kusnadi',
            'email' => 'wali10pplg1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        wali::insert([
            'nuptk' => '1234567890123456',
            'id_user' => 3,
            'nip' => '198005052022011001',
        ]);

        User::create([
            'name' => 'Himatul Munawaroh',
            'email' => 'wali11rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        wali::insert([
            'nuptk' => '2345678901234567',
            'id_user' => 4,
            'nip' => '198107062022021002',
        ]);

        User::create([
            'name' => 'Ani Nuraeni',
            'email' => 'wali12rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        wali::insert([
            'nuptk' => '3456789012345678',
            'id_user' => 5,
            'nip' => '198209072022031003',
        ]);


        // ORANG TUA
        User::create([
            'name' => 'asep',
            'email' => 'asep@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        wali_siswa::insert([
            'nik' => '1234567890123456',
            'id_user' => 6,
            'jenis_kelamin' => 'laki laki',
            'alamat' => 'Jalan dimana saja'
        ]);

        User::create([
            'name' => 'Ai',
            'email' => 'ai@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        wali_siswa::insert([
            'nik' => '2345678901234567',
            'id_user' => 7,
            'jenis_kelamin' => 'perempuan',
            'alamat' => 'Jalan dimana saja'
        ]);

        User::create([
            'name' => 'Eeng',
            'email' => 'Eeng@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        wali_siswa::insert([
            'nik' => '3456789012345678',
            'id_user' => 8,
            'jenis_kelamin' => 'laki laki',
            'alamat' => 'Jalan dimana saja'
        ]);

        // SISWA
        User::create([
            'name' => 'Reyga Marza Ramadhan',
            'email' => 'rey@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Siswa::create([
            'nis' => '0061748352',
            'id_user' => 9,
            'id_kelas' => 37,
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678901',
            'nik_ibu' => '2345678901234567',
        ]);

        User::create([
            'name' => 'Satria Galam Pratama',
            'email' => 'sat@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Siswa::create([
            'nis' => '0062894371',
            'id_user' => 10,
            'id_kelas' => 37,
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678902',
            'nik_ayah' => '3456789012345678',
        ]);

        User::create([
            'name' => 'Irma Naila Juwita',
            'email' => 'iruma@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Siswa::create([
            'nis' => '0069584720',
            'id_user' => 11,
            'id_kelas' => 23,
            'jenis_kelamin' => 'perempuan',
            'nisn' => '0045678903',
            'nik_wali' => '1234567890123456',
        ]);

        User::create([
            'name' => 'Hariz May Rayhan',
            'email' => 'Riz@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        siswa::create([
            'nis' => '0069537821',
            'id_user' => 12,
            'id_kelas' => 9,
            'jenis_kelamin' => 'laki laki',
            'nisn' => '00609129',
            'nik_ayah' => '3456789012345678',
        ]);

    }
}
