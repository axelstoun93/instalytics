<?php

namespace App\Repositories;

use App\CalendarTask;

class CalendarTaskRepository extends Repository
{
    function __construct(CalendarTask $calendarTask)
    {
        $this->model = $calendarTask;
    }


    function insert($data){
        $res = $this->model->insert($data);
        if($res){
            return true;
        }
        return false;
    }

    //Получаем часть аккаунтов по которым будем получать данные
    function getOnePart(){
        $res = $this->model->select('id','instagram_id','login')->take(50)->get();
        return $res;
    }

    //Удаляем просканированную партию
    function deleteOnePart($data){
        $res = $this->model->destroy($data);
        if($res){
            return true;
        }
        return false;
    }


    //Удаляем все записи
    function deleteAllAccount(){
        $res = $this->model::query()->delete();
        return $res;
    }

}