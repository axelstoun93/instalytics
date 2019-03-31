<?php
namespace App\Repositories\Assistant;
use Carbon\Carbon;

class DataAssistant
{

    //Функция получения количества дней
    static function getDayToTime($date)
    {
        $time =  strtotime ( $date);
        $nowTime = time();
        if(time() < $time)
        {
            $res = $time - $nowTime;
            $day = $res/60/60/24;
            return (int)floor($day);
        }
        return false;
    }


    static function backDay(){
        $date = new \DateTime();
        $date->modify('-1 day');
        return $date->format('Y-m-d');
    }

    //Формат даты d.m из Y-m-d
    static function DayAndMountFormat($data){
        $date = new \DateTime($data);
        return $date->format('d.m');
    }

    //Формат даты d.m из Y-m-d
    static function DayAndMountFormatFull($data){
        $date = new \DateTime($data);
        return $date->format('d.m.Y');
    }





    

}