<?php

namespace App\Repositories;

use App\InstagramModelAccount;
use App\Proxy;
use App\Statistic;
Use App\Repositories\Assistant\DataAssistant;
Use Illuminate\Support\Facades\DB;

class StatisticRepository extends Repository
{
    function __construct(Statistic $statistic)
    {
        $this->model = $statistic;
    }


    function insert($data){
        $res = $this->model->insert($data);
        if($res){
            return true;
        }
        return false;
    }


    //Получаем самые последние данные о аккаунте
    function getDataLast($id){
        $res = $this->model->where('instagram_id',$id)->orderBy('date', 'desc')->first();
        return $res;
    }

    //Получить 2 недели
   function getTwoWeek($id){
       $res = $this->model->where('instagram_id',$id)->limit(14)->get();

       foreach ($res  as $v){
           $v->date = DataAssistant::DayAndMountFormat($v->date);
       }

       return $res;
   }

   //Выводим информацию о приростах в ввиде таблицы
   function getTableClient($id){

       //Получаем 40 дней назад
       $oldDay =  \Carbon\Carbon::today()->subDays(40)->format('Y-m-d');

       $res = $this->model->where('instagram_id',$id)->where('date','>=',$oldDay)->get();

       $ready = [];

       $lastFollower = '';

       $growth = 0;

       $attempt = 0;


       foreach ($res as $key => $v){

           if($key === 0){
               $lastFollower = $v->follower;
               $v->growth = $v->follower - $lastFollower;
               $v->date = DataAssistant::DayAndMountFormatFull($v->date);
               $ready[] = $v;
               continue;
           }

           $growth+= $v->follower - $lastFollower;

           if($growth <= -20){
               $v->growth = ($growth >= 1) ? '+'.$growth : $growth;
               $v->date = DataAssistant::DayAndMountFormatFull($v->date);
               $ready[] = $v;
               $growth = 0;
               $lastFollower = $v->follower;
               $attempt=0;
               continue;
           }

           if($growth <= config('setting.gluing_client_table') and $attempt < 2){
               ++$attempt;
               $lastFollower = $v->follower;
               continue;
           }else{
               $v->growth = ($growth >= 1) ? '+'.$growth : $growth;
               $v->date = DataAssistant::DayAndMountFormatFull($v->date);
               $ready[] = $v;
               $growth = 0;
               $lastFollower = $v->follower;
               $attempt=0;
           }

       }

       return $ready;
   }


    function getTable($id){

        //Получаем 40 дней назад
        $oldDay =  \Carbon\Carbon::today()->subDays(40)->format('Y-m-d');

        $res = $this->model->where('instagram_id',$id)->where('date','>=',$oldDay)->get();

        $ready = [];

        $lastFollower = '';



        foreach ($res as $key => $v){

            if($key === 0){
                $lastFollower = $v->follower;
                continue;
            }

            $growth = $v->follower - $lastFollower;
            $v->growth = ($growth >= 1) ? '+'.$growth : $growth;

            $v->date = DataAssistant::DayAndMountFormatFull($v->date);
            $ready[] = $v;

            $lastFollower = $v->follower;

        }
        return $ready;
    }



    //Получаем аккаунты с маленьким приростом или с больщим количеством подписчиков

    function notificationTable($category = null){

        $accountModel = new InstagramAccountRepository(new InstagramModelAccount());

        if($category){
            $getCurrentAccount = $accountModel->getCurrentAccountandCategory($category);
        }else{
            $getCurrentAccount = $accountModel->getCurrentAccount();
        }

        //получаем 7 дней;
        $jobsWeek = \Carbon\Carbon::today()->subDays(8)->format('Y-m-d');

        $nowAccountDate = $this->model->where('date', '>', $jobsWeek)->whereNotIn(DB::raw("DAYOFWEEK(date)"),[7])->orderBy('date','DESC')->get();

        $ready = [];

        foreach ($nowAccountDate as $now){
            $ready[$now->instagram_id][] = $now;
        }

        $readyThreeDay = [];

        foreach ($ready as $key => $v){

            foreach ($v as $j => $r){

                if($j == 0){
                    $readyThreeDay[$key]['lastDayGrowth'] = $r->follower;
                    $readyThreeDay[$key]['instagram_id'] = $r->instagram_id;
                    $readyThreeDay[$key]['following'] = $r->following;
                    $readyThreeDay[$key]['growth'] = 0;
                }

                if($j == 3){
                        $readyThreeDay[$key]['firstDayGrowth'] = $r->follower;
                        $readyThreeDay[$key]['instagram_id'] = $r->instagram_id;
                        $readyThreeDay[$key]['following'] = $r->following;
                        $readyThreeDay[$key]['growth'] = $readyThreeDay[$key]['lastDayGrowth'] - $readyThreeDay[$key]['firstDayGrowth'];
                }

            }

        }



        //Делаем сверку на только продвигаймые аккаунты
        $readyNotificationAccount = [];
        foreach ($readyThreeDay as  $k => $now){

            foreach ($getCurrentAccount as $current){
                if($now['instagram_id'] === $current->instagram_id){
                    if($now['growth'] < config('setting.stats_min_growth') or $now['following'] > config('setting.stats_min_following')){
                        $readyNotificationAccount[] = $current;
                    }
                }
                else{
                    continue;
                }
            }

        }
        

        return $readyNotificationAccount;

    }


    //Получаем аккаунты с маленьким приростом или с больщим количеством подписчиков

    function growthTable($oldDate,$nowDate,$category = false){

        $accountModel = new InstagramAccountRepository(new InstagramModelAccount());

        if($category){
            $getCurrentAccount = $accountModel->getCurrentAccountandCategory($category);
        }else{
            $getCurrentAccount = $accountModel->getCurrentAccount();
        }

        $oldAccountDate = $this->model->where('date', '=', $oldDate)->get();

        $nowAccountDate = $this->model->where('date', '=', $nowDate)->get();

        $ready = [];

        //Делаем сверку на только продвигаймые аккаунты

        foreach ($nowAccountDate as $now){

            foreach ($getCurrentAccount as $current){
                if($now->instagram_id === $current->instagram_id){
                    $current->follower = $now->follower;
                    $current->following = $now->following;
                    $ready[] = $current;
                }
                else{
                    continue;
                }
            }
        }


        $result = [];
        foreach ($ready as $r){

            foreach ($oldAccountDate as $old){
                if($r->instagram_id === $old->instagram_id){
                    $growth = $r->follower - $old->follower;
                    $r->growth = ($growth >= 1) ? '+'.$growth : $growth;
                    $result[] = $r;
                }
                else{
                    continue;
                }
            }
        }

        return $result;





    }






}