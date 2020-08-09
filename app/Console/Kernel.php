<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendNewsLetter;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\SendMonthlyStats::class,
        Commands\SendNewsLetter::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        if(env('APP_ENV')==='production'){
            $schedule->command('send:newsletter')->dailyAt('10:30');
        }
        // $schedule->command('send_monthly_stats')->dailyAt('08:00')->when(function () {
        //     return \Carbon\Carbon::now()->endOfMonth()->isToday();
        // });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
