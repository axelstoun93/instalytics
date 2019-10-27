<?php

namespace App\Repositories;

use App\InstagramAccountFollowerCheck;

class InstagramAccountFollowerCheckRepository extends Repository{

    function __construct(InstagramAccountFollowerCheck $instagramAccountFollowerCheck){
        $this->model = $instagramAccountFollowerCheck;
    }

    function insert($data){

        if (is_array($data) and !empty($data)) {
            if (count($data) > 1000) {
                $explodeArray = array_chunk($data, 1000);

                $status = true;

                foreach ($explodeArray as $value) {
                    $res = $this->model->insert($value);
                    if (!$res) {
                        $status = false;
                        break;
                    }
                }

                return $status;
            } else {
                $res = $this->model->insert($data);
                if ($res) {
                    return true;
                }
                return false;
            }
        }
    }

    //Обновляем список и записываем полученный результат о том бот или нет
    function update($array){

        foreach ($array as $v){
            $account = $this->model->find($v['id'])->fill($v)->update();
        }

        return true;

    }


    //Получаем список не проверенных аккаунтов
    function getList($count){
       $res = $this->model->where('check','=','0')->take($count)->get();
       return $res;
    }

    //Получаем всех ботов
    function getAllBots(){
        $res = $this->model->where('status','=','2')->count();
        return $res;
    }

    //Получаем всех массфоловеров
    function getAllMassFollowingHumans(){
        $res = $this->model->where('status','=','1')->count();
        return $res;
    }

    //Получаем всех людей
    function getAllHumans(){
        $res = $this->model->where('status','=','0')->count();
        return $res;
    }


    //Определяем бот или нет
    function isBots($account){

        //Статус
        // Если статус 0  - человек
        // Если статус 1  - человек но подписок больше или равно  1000
        // Если статус 2  - значит Бот

        // Если набирает 3 очка ранга значит бот
        $rang = 0;

        $followingCount = $account->getFollowingCount();
        $mediaCount = $account->getMediaCount();
        $isBusiness = $account->isIsBusiness();

        //Если бизнес то не бот 100%
        if($isBusiness){
            return false;
        }

        //Если подписок больше или 1000 но меньше 2000 добовляем одно очко к рангу
        if($followingCount < 2000 and $followingCount > 1000){
            $rang+=1;
        }

        if($followingCount > 2000 and $mediaCount < 15){
            //$rang+=3;
            return 2;
        }elseif($followingCount > 2000 and $mediaCount > 15){
            $rang+=1;
        }

       //Если медиа меньше 10 штук
        if(10 > $mediaCount){
            $rang+=2;
        }

        //Определили как бота
        if($rang >= 3){
            return 2;
        }
        //Больше 1000 подписок
        if($followingCount >= 1000){
            return 1;
        }
        // Нормальный человек
        return 0;

    }

    //Проверяем пустая таблица или нет
    function isEmpty(){
      $res =  $this->model->first();
      if($res){
          return false;
      }
      return true;
    }

    //Проверяем все акаунты проверены или нет если проверены все возврощяем true
    function isCheckEmpty(){
        $res =  $this->model->where('check','=','0')->first();

        if($res){
            return false;
        }

        return true;
    }


    public function clearList(){
        $res =  $this->model->truncate();
        if($res){
            return true;
        }
        return false;
    }

    //Получаем первый аккаунт и меняем у него статус так как его уже нет забанели или удалили
    public function updateRow($id,$array){
        $res = $this->model->find($id)->fill(['is_bots' => 1,'check' => 1])->update();
        return $res;
    }


}
