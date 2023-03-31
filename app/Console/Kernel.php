<?php

namespace App\Console;

use App\Jobs\cekTunnelExpiredJob;
use App\Repositories\RouterOsRepository;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        Commands\ExpireTunnels::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
         $schedule->command('app:expire-tunnels')->everyMinute();
        $routerOsRepository = RouterOsRepository::class;
        $schedule->job(new cekTunnelExpiredJob($routerOsRepository))->daily();
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
