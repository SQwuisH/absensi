<?php

namespace App\Console\Commands;

use App\Models\absensi;
use App\Models\siswa;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InsertAbsen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-absen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

     public function __construct()
    {
        parent::__construct();
    }

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
            // Cek apakah absensi untuk siswa ini dan tanggal hari ini sudah ada
            $absensi = Absensi::where('nis', $siswa->nis)
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

        $this->info('Default absensi created successfully for all students.');
    }
}
