<?php
namespace App\Repositories;

use App\Pay;
use App\Repositories\Assistant\DataAssistant;

class PayRepository extends Repository
{
    function __construct(Pay $pay){
        $this->model = $pay;
    }

    function getLastId(){
        $res = $this->model->all()->last();
        if(!empty($res->id) && $res->id > 0)
        {
            $id = $res->id + 1;
        }else
        {
            $id = 0;
        }
        return $id;
    }

    //Добовляем платеж
    function addPay($request){
        $setting = $this->model->create([
            'user_id' =>  $request->user_id,
            'amount' => $request->amount,
            'status' => 1,
            'check' => 0,
            'date' =>  DataAssistant::nowDay()
        ]);
        if($setting) {
            return true;
        }else
        {
            return false;
        }
    }

    function updatePay($id,$userId,$status,$check){
        $pay = $this->model->where('id','=',$id)->where('check','=',0)->where('user_id','=',$userId)->get();
        if(!empty($pay->last())){
        $array = [
            'status' => $status,
            'check'  => $check
        ];
        $update = $this->model->find($id)->fill($array)->update();
        return $update;
        }
        else{
                return false;
        }
    }

    function getPay($id){
        $res = $this->model->where('user_id','=',$id)->orderBy('id', 'desc')->get();
        return $res;
    }
}
