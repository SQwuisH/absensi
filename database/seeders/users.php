<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Reyga Marza Ramadhan',
            'email' => 'rey@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Satria Galam Pratama',
            'email' => 'sat@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Irma Naila Juwita',
            'email' => 'iruma@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Engkus Kusnadi',
            'email' => 'wali10pplg1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Himatul Munawaroh',
            'email' => 'wali11rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Ani Nuraeni',
            'email' => 'wali12rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'walisiswa1',
            'email' => 'walisiswa1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'walisiswa2',
            'email' => 'walisiswa2@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'walisiswa3',
            'email' => 'walisiswa3@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Hariz May Rayhan',
            'email' => 'Riz@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
