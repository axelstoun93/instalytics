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

        //Получаем данные
        $schedule->call('App\Http\Controllers\CronController@getTask')->everyFiveMinutes();

        //Получаем данные по ANDROID API - каждые 3 минуты
        $schedule->call('App\Http\Controllers\CronController@getAndroidTask')->cron("*/3 * * * *");

        //Чистим таблицу follower_user_list
        $schedule->call('App\Http\Controllers\CronController@clearFollowerUserList')->cron("0 */3 * * *");

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
