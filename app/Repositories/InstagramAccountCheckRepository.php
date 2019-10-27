<?php

namespace App\Repositories;

use App\InstagramAccountCheck;
use App\Repositories\Assistant\DataAssistant;

class InstagramAccountCheckRepository extends Repository{

    function __construct(InstagramAccountCheck $instagramAccountCheck){
        $this->model = $instagramAccountCheck;
    }

    //Получаем первый аккаунт который требует проверки
    function getFirstAccount(){
        $one = $this->model->where('status','=',0)->first();
        return $one;
    }


    //Ставим аккаунт на проверку
    function create($instagramId){

        $nowDay = DataAssistant::nowDay();

        $result = $this->model->create([
            'instagram_id' => $instagramId,
            'date' => $nowDay
        ]);

        return $result;

    }

    function update($id,$array){
        $account = $this->model->find($id)->fill($array)->update();
        return $account;
    }

    function updateByInstagramId($id,$array){
        $account = $this->model->where('instagram_id','=',$id)->first()->fill($array)->update();
        return $account;
    }

    //Получаем аккаунт по instagram_id
    function getByInstagramId($id){
        $one = $this->model->where('instagram_id','=',$id)->first();
        return $one;
    }

    //Получаем данные в виде Json строки
    function getJsonDataById($id){
        $res = $this->model->where('instagram_id','=',$id)->first();

        if(!empty($res)){
            //Дабовляем поле с датой в русском формате
            $res->date_rus = DataAssistant::DayAndMountFormatFull($res->date);

            $ready['json'] = json_encode([['name' => 'Люди','value' => $res->humans], ['name' => 'Массфоловеры','value' => $res->mass_following_humans] , ['name' => 'Боты','value' => $res->bots]]);
            $ready['data'] = $res;
            return $ready;
        }

        return false;
    }

    public function delete($id){
        $checkAccount = $this->model->where('instagram_id','=',$id)->first();

        if($checkAccount->delete()) {
           return true;
        }else {
           return false;
        }
    }


}
