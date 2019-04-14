<?php

namespace App\Repositories;

use App\InstagramModelAccount;
use App\Repositories\Api\InstagramAccount;

class InstagramAccountRepository extends Repository
{
    function __construct(InstagramModelAccount $instagramAccount)
    {
        $this->model = $instagramAccount;
    }



    function addInstagramAccount(InstagramAccount $instagramAccount,$category,$user_id,$bots){

        $account = $this->model->create([
            'user_id' => $user_id,
            'instagram_id' => $instagramAccount->id,
            'avatar' => $instagramAccount->avatar,
            'name' => $instagramAccount->name,
            'login' => $instagramAccount->login,
            'follower' => $instagramAccount->follower,
            'following' => $instagramAccount->following,
            'media_count' => $instagramAccount->countMedia,
            'category_id' => $category,
            'promotion' => 1,
            'bots' => $bots
        ]);

        if($account){
            return true;
        }

        return false;
    }


    //Проверка на уникальность
    function uniqueId($id){
            $res = $this->model->where('instagram_id','=',$id)->first();
            if($res){
                return true;
            }
            return false;
    }


    //Получаем аккаунты для запроса их статуса
    function getAllAccount(){
        $res = $this->model->select('login','instagram_id')->get();
        return $res;
    }


    //Получаем только актуальные аккаунты
    function getCurrentAccount(){
        $res = $this->model->where('promotion','=',1)->get();
        return $res;
    }

    //Получаем только актуальные аккаунты и категорию тех к кому относяться
    function getCurrentAccountandCategory($category){
        $res = $this->model->where('promotion','=',1)->where('category_id','=',$category)->get();
        return $res;
    }

   //Обновляем статус аккаунтов
    function updateStatus($array){
        if(!empty($array) and is_array($array)){
            foreach ($array as $v){
                $res = $this->model->where('instagram_id','=',$v['instagram_id'])->update(['status'=>$v['status']]);
                if(!$res){
                    return false;
                }
            }
        }
    }


    //Обновляем логин
    function updateLogin($array){
        if(!empty($array) and is_array($array) ){
            foreach ($array as $v){
                $res = $this->model->where('instagram_id','=',$v['instagram_id'])->update(['login' => $v['login'],'old_login' => $v['old_login']]);
                if(!$res){
                    return false;
                }
            }
        }
    }

    //Обновляем статус продвижения
    function updateClient($user_id,$request){
        $res = $this->model->where('user_id','=',$user_id)->update(['promotion' => $request->promotion,'bots' => $request->bots,'category_id' =>  $request->category]);
        if($res){
            return true;
        }
        return false;
    }



}