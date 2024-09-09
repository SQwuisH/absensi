<?php

namespace App\Console\Commands;

use App\Models\absensi;
use App\Models\siswa;
use App\Models\User;
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
    }
}
