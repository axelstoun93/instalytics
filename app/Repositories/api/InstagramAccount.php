<?php

namespace App\Repositories\Api;

class InstagramAccount extends Instagram
{

    public $follower;
    public $following;
    public $login;
    public $name;
    public $id;
    public $avatar;
    public $countMedia;



    function getAccountLogin($name){

        $url = $this->url.$name;

        $jsonData = '';

        if(!$jsonData = $this->validateCurl($url)){
            return false;
        }

        if(!empty($jsonData["entry_data"])){
            $this->follower = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_followed_by"]["count"];
            $this->following = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_follow"]["count"];
            $this->login = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]['username'];
            $this->name = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]['full_name'];
            $this->id = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]['id'];
            $this->avatar = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]["profile_pic_url_hd"];
            $this->countMedia = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]['count'];
            return true;
        }else{
            return false;
        }

    }

    function getAccountId($id){

        $url = "https://i.instagram.com/api/v1/users/".$id."/info/";

        $jsonData = '';

        if(!$this->validateCurl($url)){
            return false;
        }

        if(!empty($jsonData->user)){
            $this->follower = $jsonData->user->follower_count;
            $this->following = $jsonData->user->following_count;
            $this->login =  $jsonData->user->username;
            $this->name =  $jsonData->user->full_name;
            $this->id =   $jsonData->user->pk;
            $this->avatar = $jsonData->user->hd_profile_pic_url_info->url;
            $this->countMedia = $jsonData->user->media_count;
            return true;
        }else{
            return false;
        }

    }

    function validateCurl($url){

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');

        $html = curl_exec($ch);
        curl_close($ch);

        if($html) {
            $findData = preg_match('/window._sharedData\s*=(.+)(?=;|<\}\}\;)/', strip_tags($html), $data);
            if(!empty($data[1])){
                return  json_decode($data[1],true);
            }return false;
        }return false;

    }

}