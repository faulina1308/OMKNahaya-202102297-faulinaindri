<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\UpdateKegiatanStatus::class,
        Commands\KirimPengingat::class,
    ];
    protected function schedule(Schedule $schedule){
        $schedule->command('app:update-kegiatan-status')->dailyAt('05:00');
        $schedule->command('app:kirim-pengingat')->dailyAt('19:00');
    }
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}