<?php
namespace App\Repositories;

use App\FollowList;
use App\Repositories\Assistant\DataAssistant;

class FollowListRepository extends Repository
{
    function __construct(FollowList $followList)
    {
        $this->model = $followList;
    }

    function insert($data){
        if(is_array($data) and !empty($data)){
            if(count($data) > 1000){
                $explodeArray = array_chunk($data, 1000);

                $status = true;

                foreach ($explodeArray as $value){
                    $res = $this->model->insert($value);
                    if(!$res){
                        $status = false;
                        break;
                    }
                }

                return $status;
            }else{
                $res = $this->model->insert($data);
                if($res){
                    return true;
                }
                return false;
            }
        }
        //Если все плохо возвращяем пустой ответ
        return false;
    }

    //Получаем список тех кто подписался за день
    function getFollowListDay($id,$date = false){
        $id = (int)$id;

        if(empty($date)){
            $date =  DataAssistant::backDay();
        }

        $res = $this->model->where('instagram_id',$id)->where('date','=',$date)->get();

        if(!empty($res)){
            foreach ($res as $v){
                $v->date_rus = DataAssistant::DayAndMountFormatFull($v->date);
            }
        }

        return $res;
    }

    //Получаем доступные записи за 30 дней
    function getFollowListDate($id){
        $id = (int)$id;
        $oldDay =  \Carbon\Carbon::today()->subDays(30)->format('Y-m-d');
        $res = $this->model->select('date')->distinct()->where('instagram_id',$id)->where('date','>=',$oldDay)->orderBy('date', 'desc')->get();
        foreach ($res as $v){
            $v->date_rus = DataAssistant::DayAndMountFormatFull($v->date);
        }
        return $res;
    }

}
