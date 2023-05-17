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
        // $schedule->command('inspire')->hourly();

        // 毎分
        $schedule->command('mail:send-daily-tweet-count-mail')->everyMinute()->cron('* * * * *');
        // 毎時
        // $schedule->command('sampleCommand')->hourly();
        // 毎時何分
        // $schedule->command('sampleCommand')->hourlyAt(8);
        // 毎日
        // $schedule->command('sampleCommand')->daily(8);
        // 毎日何時
        // $schedule->command('mail:send-daily-tweet-count-mail')->dailyAt("9:49");
        // 毎日何時cron表記
        // $schedule->command('sampleCommand')->cron("15 3 * * *");

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
