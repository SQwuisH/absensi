<?php

namespace Database\Seeders;

use App\Models\absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class absenSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nis = '0069537821';
        $titikKoordinat = '-6.890622076541303, 107.55806983605572';

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-01_masuk.png',
            'foto_pulang' => '0062894371_2024-08-01_keluar.png',
            'date' => '2024-07-01',
            'jam_masuk' => '06:12:34',
            'jam_pulang' => '16:45:56',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-02_masuk.png',
            'foto_pulang' => '0062894371_2024-08-02_keluar.png',
            'date' => '2024-07-02',
            'jam_masuk' => '06:45:12',
            'jam_pulang' => '16:30:22',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-03_masuk.png',
            'foto_pulang' => '0062894371_2024-08-03_keluar.png',
            'date' => '2024-07-03',
            'jam_masuk' => '06:30:45',
            'jam_pulang' => '17:15:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-04_masuk.png',
            'foto_pulang' => '0062894371_2024-08-04_keluar.png',
            'date' => '2024-07-04',
            'jam_masuk' => '07:10:00',
            'jam_pulang' => '16:55:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-05_masuk.png',
            'foto_pulang' => '0062894371_2024-08-05_keluar.png',
            'date' => '2024-07-05',
            'jam_masuk' => '06:00:00',
            'jam_pulang' => '16:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Sakit',
            'foto_masuk' => '0062894371_2024-08-06_masuk.png',
            'foto_pulang' => null,
            'date' => '2024-07-06',
            'jam_masuk' => null,
            'jam_pulang' => null,
            'titik_koordinat_masuk' => null,
            'titik_koordinat_pulang' => null,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Sakit',
            'foto_masuk' => '0062894371_2024-08-06_masuk.png',
            'foto_pulang' => null,
            'date' => '2024-07-07',
            'jam_masuk' => null,
            'jam_pulang' => null,
            'titik_koordinat_masuk' => null,
            'titik_koordinat_pulang' => null,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-08_masuk.png',
            'foto_pulang' => '0062894371_2024-08-08_keluar.png',
            'date' => '2024-07-08',
            'jam_masuk' => '06:55:00',
            'jam_pulang' => '16:50:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-09_masuk.png',
            'foto_pulang' => '0062894371_2024-08-09_keluar.png',
            'date' => '2024-07-09',
            'jam_masuk' => '06:15:00',
            'jam_pulang' => '17:10:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-10_masuk.png',
            'foto_pulang' => '0062894371_2024-08-10_keluar.png',
            'date' => '2024-07-10',
            'jam_masuk' => '07:00:00',
            'jam_pulang' => '16:25:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Izin',
            'foto_masuk' => '0062894371_2024-08-11_masuk.png',
            'foto_pulang' => null,
            'date' => '2024-07-11',
            'jam_masuk' => null,
            'jam_pulang' => null,
            'titik_koordinat_masuk' => null,
            'titik_koordinat_pulang' => null,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-12_masuk.png',
            'foto_pulang' => '0062894371_2024-08-12_keluar.png',
            'date' => '2024-07-12',
            'jam_masuk' => '06:35:00',
            'jam_pulang' => '16:32:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-13_masuk.png',
            'foto_pulang' => '0062894371_2024-08-13_keluar.png',
            'date' => '2024-07-13',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '16:40:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-14_masuk.png',
            'foto_pulang' => '0062894371_2024-08-14_keluar.png',
            'date' => '2024-07-14',
            'jam_masuk' => '06:50:00',
            'jam_pulang' => '16:15:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'TAP',
            'foto_masuk' => '0062894371_2024-08-15_masuk.png',
            'foto_pulang' => null,
            'date' => '2024-07-15',
            'jam_masuk' => '06:05:00',
            'jam_pulang' => null,
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => null,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Terlambat',
            'foto_masuk' => '0062894371_2024-08-16_masuk.png',
            'foto_pulang' => '0062894371_2024-08-16_keluar.png',
            'date' => '2024-07-16',
            'jam_masuk' => '08:15:00',
            'jam_pulang' => '16:50:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
            'keterangan' => '180',
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-17_masuk.png',
            'foto_pulang' => '0062894371_2024-08-17_keluar.png',
            'date' => '2024-07-17',
            'jam_masuk' => '06:40:00',
            'jam_pulang' => '16:25:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-18_masuk.png',
            'foto_pulang' => '0062894371_2024-08-18_keluar.png',
            'date' => '2024-07-18',
            'jam_masuk' => '06:55:00',
            'jam_pulang' => '16:59:12',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Terlambat',
            'foto_masuk' => '0062894371_2024-08-19_masuk.png',
            'foto_pulang' => '0062894371_2024-08-19_keluar.png',
            'date' => '2024-07-19',
            'jam_masuk' => '08:12:01',
            'jam_pulang' => '17:15:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
            'keterangan' => '60',
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Alfa',
            'foto_masuk' => null,
            'foto_pulang' => null,
            'date' => '2024-07-20',
            'jam_masuk' => null,
            'jam_pulang' => null,
            'titik_koordinat_masuk' => null,
            'titik_koordinat_pulang' => null,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-21_masuk.png',
            'foto_pulang' => '0062894371_2024-08-21_keluar.png',
            'date' => '2024-07-21',
            'jam_masuk' => '06:55:00',
            'jam_pulang' => '16:30:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-22_masuk.png',
            'foto_pulang' => '0062894371_2024-08-22_keluar.png',
            'date' => '2024-07-22',
            'jam_masuk' => '07:00:00',
            'jam_pulang' => '16:55:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-23_masuk.png',
            'foto_pulang' => '0062894371_2024-08-23_keluar.png',
            'date' => '2024-07-23',
            'jam_masuk' => '06:40:00',
            'jam_pulang' => '16:40:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'TAP',
            'foto_masuk' => '0062894371_2024-08-24_masuk.png',
            'foto_pulang' => '0062894371_2024-08-24_keluar.png',
            'date' => '2024-07-24',
            'jam_masuk' => '06:10:00',
            'jam_pulang' => null,
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => null,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-25_masuk.png',
            'foto_pulang' => '0062894371_2024-08-25_keluar.png',
            'date' => '2024-07-25',
            'jam_masuk' => '06:30:00',
            'jam_pulang' => '17:05:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-26_masuk.png',
            'foto_pulang' => '0062894371_2024-08-26_keluar.png',
            'date' => '2024-07-26',
            'jam_masuk' => '06:45:00',
            'jam_pulang' => '16:35:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-07-27',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Terlambat',
            'foto_masuk' => '0062894371_2024-08-28_masuk.png',
            'foto_pulang' => '0062894371_2024-08-28_keluar.png',
            'date' => '2024-07-28',
            'jam_masuk' => '07:40:00',
            'jam_pulang' => '17:10:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
            'keterangan' => '43',
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Alfa',
            'foto_masuk' => null,
            'foto_pulang' => null,
            'date' => '2024-07-29',
            'jam_masuk' => null,
            'jam_pulang' => null,
            'titik_koordinat_masuk' => null,
            'titik_koordinat_pulang' => null,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-01',
            'jam_masuk' => '06:21:33',
            'jam_pulang' => '16:20:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-02',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-03',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-04',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-05',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-06',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-07',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-08',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-09',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-10',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-11',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        Absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'foto_masuk' => '0062894371_2024-08-27_masuk.png',
            'foto_pulang' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-08-12',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

    }
}
