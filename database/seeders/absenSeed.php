<?php

namespace Database\Seeders;

use App\Models\absensi;
use App\Models\siswa;
use Carbon\Carbon;
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
        $photo = "default.png";
        $now = Carbon::yesterday();

        $titikKoordinat = '-6.890622076541303, 107.55806983605572';
        foreach ($siswa as $s) {
            $random = rand(0, 5);
            $status = [
                "hadir",
                "sakit",
                "izin",
                "alfa",
                "terlambat",
                "TAP"
            ];
            if($status[$random] == "sakit" || $status[$random] == "izin" || $status[$random] == "TAP")
            {
                absensi::create([
                    'nis' =>  "00$s->nis",
                    'status' => $status[$random],
                    'foto_masuk' => $photo,
                    'foto_pulang' => $photo,
                    'date' => $now,
                    'jam_masuk' => '06:20:00',
                    'titik_koordinat_masuk' => $titikKoordinat,
                    'titik_koordinat_pulang' => $titikKoordinat,
                ]);
            }
            elseif($status[$random] == "hadir" || $status[$random] == "terlambat")
            {
                absensi::create([
                    'nis' =>  "00$s->nis",
                    'status' => $status[$random],
                    'foto_masuk' => $photo,
                    'foto_pulang' => $photo,
                    'date' => $now,
                    'jam_masuk' => '06:20:00',
                    'jam_pulang' => '17:00:00',
                    'titik_koordinat_masuk' => $titikKoordinat,
                    'titik_koordinat_pulang' => $titikKoordinat,
                ]);
            }
            else
            {
                absensi::create([
                    'nis' =>  "00$s->nis",
                    'status' => $status[$random],
                    'foto_masuk' => $photo,
                    'foto_pulang' => $photo,
                    'date' => $now,
                    'titik_koordinat_masuk' => $titikKoordinat,
                    'titik_koordinat_pulang' => $titikKoordinat,
                ]);
            }
        }
    }
}
