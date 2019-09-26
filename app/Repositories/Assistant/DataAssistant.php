<?php
namespace App\Repositories\Assistant;
use Carbon\Carbon;

class DataAssistant
{

    //Функция получения количества дней
    static function getDayToTime($date)
    {
        $time =  strtotime ($date);
        $nowTime = time();
        if(time() < $time)
        {
            $res = $time - $nowTime;
            $day = $res/60/60/24;
            return (int)(floor($day) + 1);
        }
        return false;
    }


    // -1 день
    static function backDay(){
        $date = new \DateTime();
        $date->modify('-1 day');
        return $date->format('Y-m-d');
    }

    // -2 дня
    static function oldBackDay(){
        $date = new \DateTime();
        $date->modify('-2 day');
        return $date->format('Y-m-d');
    }

    // -3 дня
    static function backThreeDay(){
        $date = new \DateTime();
        $date->modify('-3 day');
        return $date->format('Y-m-d');
    }

    //Формат даты d.m из Y-m-d
    static function DayAndMountFormat($data){
        $date = new \DateTime($data);
        return $date->format('d.m');
    }

    //Формат даты d.m.Y из Y-m-d
    static function DayAndMountFormatFull($data){
        $date = new \DateTime($data);
        return $date->format('d.m.Y');
    }


    //Формат даты Y-m-d сегодня
    static function nowDay(){
        $date = new \DateTime();
        return $date->format('Y-m-d');
    }


    //Формат даты Y-m-d сегодня
    static function nextThreeDay(){
        $date = new \DateTime();
        $date->modify('+3 day');
        return $date->format('Y-m-d');
    }










}