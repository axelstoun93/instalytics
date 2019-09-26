<?php
namespace App\Repositories;

use App\CalendarAndroidTask;

class CalendarAndroidTaskRepository extends Repository
{
    function __construct(CalendarAndroidTask $calendarAndroidTask)
    {
        $this->model = $calendarAndroidTask;
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
        $res = $this->model->select('id','instagram_id','login')->take(1)->get();
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

    //Удаляем первый аккаунт из списка, например если не существует аккаунт
    function deleteFirstAccount(){
       $first =  $this->model->first();
       $result = $first->delete();
       return $result;
    }

    //Удаляем все записи
    function deleteAllAccount(){
        $res = $this->model::query()->delete();
        return $res;
    }

}
