<?php

namespace App\Console;

use App\Models\waktu_absen;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $waktu = waktu_absen::first();
        $schedule->command('app:insert-absen')->dailyAt("00:01");
        $schedule->command('app:cek-tap')->at($waktu->batas_pulang);
        $schedule->command('app:reset-tap')->monthly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
