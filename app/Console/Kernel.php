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
        $schedule->call('App\Http\Controllers\CronController@getTaskNew')->everyTenMinutes();

        //Получаем данные по ANDROID API - каждые 3 минуты
        $schedule->call('App\Http\Controllers\CronController@getAndroidTask')->cron("*/3 * * * *");

        //Чистим таблицу каждые 3 часа follower_user_list
        $schedule->call('App\Http\Controllers\CronController@clearFollowerUserList')->cron("0 */3 * * *");

        //Проверки на ботов
        //Проверяем очередь аккаунтов каждые 2 часа
        $schedule->call('App\Http\Controllers\AccountCronController@init')->cron("0 */2 * * *");

        //Делаем анализ аудитории по 500 штук пока не проверим всю аудиторию и не запишем данные в проверяемый аккаунт, каждые 8 минут
        $schedule->call('App\Http\Controllers\AccountCronController@checkAccountFollowers')->cron("*/8 * * * *");
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
