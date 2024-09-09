<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test()
    {
        $today = Carbon::today();

        // Cek apakah hari ini akhir pekan
        if ($today->isWeekend()) {
            $this->info('Hari ini adalah akhir pekan, absensi tidak dibuat.');
            return;
        }

        // Dapatkan semua siswa
        $siswaList = siswa::all();
        $todayDate = $today->toDateString();

        foreach ($siswaList as $siswa) {
            // Cek apakah absensi untuk siswa ini dan tanggal hari ini sudah ada
            $absensi = Absensi::where('nis', '00' . $siswa->nis)
                              ->whereDate('date', $todayDate)
                              ->first();

            if (!$absensi) {
                // Jika tidak ada, buat absensi baru dengan status 'Alfa'
                Absensi::create([
                    'nis' => '00' . $siswa->nis,
                    'status' => 'Alfa',
                    'date' => $todayDate,
                ]);
            }
        }
    }
}
