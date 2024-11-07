<?php

namespace Database\Seeders;

use App\Models\absensi;
use App\Models\siswa;
use App\Models\waktu_absen;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Code16\CarbonBusiness\BusinessDays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class absenSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = siswa::all();
        $waktu = waktu_absen::first();
        $photo = "default.png";
        $status = [
            "hadir",
            "alfa",
            "hadir",
            "hadir",
            "hadir",
            "izin",
            "sakit",
            "hadir",
            "hadir",
            "hadir",
            "izin",
            "sakit",
            "hadir",
            "hadir",
            "hadir",
            "hadir",
            "alfa",
            "hadir",
            "izin",
            "sakit",
        ];

        $jam_masuk = [
            '06:30:00',
            '07:41:00',
            '08:16:00',
            '06:45:00',
            '06:55:00',
            '06:12:00',
            '06:48:00',
        ];

        $jam_pulang = [
            '15:05:00',
            '16:26:00',
            '15:48:00',
            '15:35:00',
            '16:07:00',
            '15:44:00',
            '15:51:00',
        ];

        $batas_absen = carbon::createFromTimeString("$waktu->batas_absen");

        $batas_pulang = carbon::createFromTimeString("$waktu->batas_pulang");

        $dateRange = new CarbonPeriod('2024-07-28', '1 days', Carbon::yesterday()->format('Y-m-d'));

        $titikKoordinat = '-6.890622076541303, 107.55806983605572';
        foreach ($siswa as $s) {
            foreach ($dateRange as $date) {
                if (Carbon::createFromDate($date)->isWeekday()) {
                    $random = rand(0, 14);
                    $masuk = rand(0, 6);

                    if ($status[$random] == "sakit" || $status[$random] == "izin") {
                        absensi::create([
                            'nis' =>  "00$s->nis",
                            'status' => $status[$random],
                            'foto_masuk' => $photo,
                            'foto_pulang' => $photo,
                            'date' => $date,
                            'keterangan' => "Tidak Bisa Masuk Kelas",
                            'jam_masuk' => $jam_masuk[$masuk],
                            'titik_koordinat_masuk' => $titikKoordinat,
                        ]);
                    } elseif ($status[$random] == "hadir") {
                        $menit_keterlambatan = null;
                        $menit_TAP = null;
                        $pulang = rand(0, 6);

                        if ($masuk == 1 || $masuk == 2) {
                            $menit_keterlambatan = Carbon::createFromTimeString("$jam_masuk[$masuk]")->diffInMinutes($batas_absen);
                        }

                        if ($pulang == 1 || $pulang ==  4) {
                            $menit_TAP = Carbon::createFromTimeString("$jam_pulang[$pulang]")->diffInMinutes($batas_pulang);
                        }

                        absensi::create([
                            'nis' =>  "00$s->nis",
                            'status' => $status[$random],
                            'foto_masuk' => $photo,
                            'foto_pulang' => $photo,
                            'date' => $date,
                            'menit_keterlambatan' => $menit_keterlambatan,
                            'menit_TAP' => $menit_TAP,
                            'jam_masuk' => $jam_masuk[$masuk],
                            'jam_pulang' => $jam_pulang[$pulang],
                            'titik_koordinat_masuk' => $titikKoordinat,
                            'titik_koordinat_pulang' => $titikKoordinat,
                        ]);

                    } else {
                        absensi::create([
                            'nis' =>  "00$s->nis",
                            'status' => $status[$random],
                            'date' => $date,
                        ]);
                    }
                }
            }
        }
    }
}
