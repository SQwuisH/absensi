<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\wali;

class WaliKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        wali::insert([
            'nuptk' => '1234567890123456',
            'id' => 5,
            'nip' => '198005052022011001',
        ]);

        wali::insert([
            'nuptk' => '2345678901234567',
            'id' => 6,
            'nip' => '198107062022021002',
        ]);

        wali::insert([
            'nuptk' => '3456789012345678',
            'id' => 7,
            'nip' => '198209072022031003',
        ]);
    }
}
