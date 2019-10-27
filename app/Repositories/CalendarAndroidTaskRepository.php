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
        $res = $this->model->select('id','instagram_id','login','rank_token','next_max_id')->take(3)->get();
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
        $result =  $this->model->first()->delete();
       return $result;
    }

    //Удаляем все записи
    function deleteAllAccount(){
        $res = $this->model->truncate();
        return $res;
    }

    //Обновляем запись
    function update($id,$array){
        $account = $this->model->find($id)->fill($array)->update();
        return $account;
    }

    function isEmpty(){
        $res =  $this->model->first();
        if($res){
            return false;
        }
        return true;
    }

}
