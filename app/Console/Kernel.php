<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call('App\Http\Controllers\CronController@init')->dailyAt('0:01');
        $schedule->call('App\Http\Controllers\CronController@index')->everyFiveMinutes();

        //Смс оповещение

        //День оплаты
        $schedule->call('App\Http\Controllers\SmsCronController@payDayNotification')->dailyAt('10:00');

        //За 3 дня до оплаты
        $schedule->call('App\Http\Controllers\SmsCronController@payDayThreeNotification')->dailyAt('10:30');



    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
