<?php

namespace App\Repositories\Api;
use InstagramAPI\Instagram;
use App\Repositories\InstagramDonorRepository;
use App\InstagramDonor;

/* singleton */
class InstagramAndroidApi
{

    private static $_instance = null;

    private $android;

    private $rankToken;

    private $nextMaxId = false;

    public function __construct($donor) {
        $debug = false;
        $truncatedDebug = false;

        $this->android = new Instagram($debug,$truncatedDebug);
        $this->rankToken = \InstagramAPI\Signatures::generateUUID();

        try {

            if(!empty($donor->proxy)){
                $donorProxyString = 'http://'.$donor->proxy->name.':'.$donor->proxy->password.'@'.$donor->proxy->ip.':'.$donor->proxy->port;
                $this->android->setProxy($donorProxyString);}

            //Проходим авторизацию
            $this->android->login($donor->name,$donor->password);

        }catch (\Exception $e){
            //Если не авторизовался отключаемся
            $donor_rep = new InstagramDonorRepository(new InstagramDonor());
            $res = $donor_rep->updateStatus($donor->id,0);
        }
    }

    public function getFollowers($instagramId){

        $followers = [];

        $maxId = null;

        do {
            $response = $this->android->people->getFollowers($instagramId,$this->rankToken,null,$maxId);
            $followers = array_merge($followers, $response->getUsers());
            $maxId = $response->getNextMaxId();
        } while ($maxId !== null);

        return $followers;
    }

    public function getInfoUserById($id){
        $account = $this->android->people->getInfoById($id)->getUser();
        return $account;
    }

    //Получаем число подписчиков на данный момент
    public function getCountFollowers($id){
      $res =  $this->android->people->getInfoById($id)->getUser()->getFollowerCount();
      return $res;
    }

    public function getIdByLogin($name){
        $userId = $this->android->people->getUserIdForName($name);
        return $userId;
    }


    public function __destruct(){
        $this->android->logout();
    }

    public function getPageFollowers($instagramId,$nextMaxId = null, $rankToken = null){

        //105 - 20 309

        $followers = [];

        $count = 0;

        $maxId = null;

        if(!empty($nextMaxId)){
            $maxId = $nextMaxId;
        }

        if(!empty($rankToken)){
            $this->rankToken = $rankToken;
        }

        do {
            $response = $this->android->people->getFollowers($instagramId,$this->rankToken,null,$maxId);
            $followers = array_merge($followers, $response->getUsers());
            $maxId = $response->getNextMaxId();
            $this->nextMaxId = $maxId;
            ++$count;
            if($count == 105){
                return $followers;
            }
        } while ($maxId !== null);

        return $followers;
    }

    public function getNexMaxId(){
        return $this->nextMaxId;
    }

    public function getRankToken(){
        return $this->rankToken;
    }

}
