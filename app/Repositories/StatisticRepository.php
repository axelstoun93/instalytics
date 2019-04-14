<?php

namespace App\Repositories;

use App\InstagramModelAccount;
use App\Statistic;

Use App\Repositories\Assistant\DataAssistant;

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

       $res = $this->model->where('instagram_id',$id)->limit(40)->get();

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

        $res = $this->model->where('instagram_id',$id)->limit(40)->get();

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

        //Проверяем суббота или нет
        $saturday = \Carbon\Carbon::today()->subDays(1)->format('N');

        if($saturday == 6){
            //Получаем дату которая была 4 дня назад
            $oldDate = \Carbon\Carbon::today()->subDays(5)->format('Y-m-d');

            //Сейчас
            $nowDate = \Carbon\Carbon::today()->subDays(2)->format('Y-m-d');
        }else{
            //Получаем дату которая была 3 дня назад
            $oldDate = \Carbon\Carbon::today()->subDays(4)->format('Y-m-d');

            //Сейчас
            $nowDate = \Carbon\Carbon::today()->subDays(1)->format('Y-m-d');
        }

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
                    if($growth < config('setting.stats_min_growth') or $r->following > config('setting.stats_min_following')){
                        $result[] = $r;
                    }
                }
                else{
                    continue;
                }
            }
        }

        return $result;

    }






}