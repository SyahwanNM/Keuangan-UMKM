<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Auto calculate monthly taxes on the 1st of every month at 9:00 AM
        $schedule->command('tax:calculate-monthly')
                 ->monthlyOn(1, '9:00')
                 ->timezone('Asia/Jakarta')
                 ->withoutOverlapping()
                 ->appendOutputTo(storage_path('logs/tax-calculation.log'));
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



