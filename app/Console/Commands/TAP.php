<?php

namespace App\Console\Commands;

use App\Models\absensi;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TAP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cek-tap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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
            $absensi = absensi::where('nis', $siswa->nis)->wheredate('date', $todayDate)->first();

            if ($absensi->status == "terlambat" || $absensi->status == "hadir") {
                if ($absensi->foto_pulang == null || $absensi->titik_koordinat_pulang == null) {
                    absensi::where('id_absensi', $absensi->id_absensi)->update([
                        'status' => "TAP"
                    ]);
                }
            }
        }

        $this->info('cek update TAP successfully for all students.');
    }
}
