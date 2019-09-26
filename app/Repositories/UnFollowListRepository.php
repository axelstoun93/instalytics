<?php
namespace App\Repositories;

use App\Repositories\Assistant\DataAssistant;
use App\UnFollowList;

class UnFollowListRepository extends Repository
{
    function __construct(UnFollowList $unFollowList)
    {
        $this->model = $unFollowList;
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

    function getUnfollowListDay($id,$date = false){
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


}
