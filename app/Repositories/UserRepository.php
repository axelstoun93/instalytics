<?php

namespace App\Repositories;
use App\Repositories\Api\InstagramAccount;
use App\User;
use App\InstagramModelAccount;
use Image;

use App\Repositories\Assistant\DataAssistant;

class UserRepository extends Repository
{
    function __construct(User $user)
    {
        $this->model = $user;
    }

    // метод получения имени и роли пользователя
    function userInfo ($id)
    {
        $user = $this->model->find($id);
        return   $user;
    }

    // метод получения информации о клиенте
    function clientInfo ($id)
    {
        $user = $this->model->find($id);
        $user->load('account');
        $user->pay_day_full =  DataAssistant::DayAndMountFormatFull($user->pay_day);
        $user->pay_day =  DataAssistant::getDayToTime($user->pay_day);
        return   $user;
    }

    // получить по id имя
    function getNameID($id)
    {
      $res = $this->model->select('id')->find($id);
      return $res;
    }

    // Добавить клиента
    function addClient($request)
    {

        $instagram = new InstagramAccount();

        $instagramRepository = new InstagramAccountRepository(new InstagramModelAccount());

        if($instagram->getAccountLogin($request->name)){

            $img = Image::make($instagram->avatar)->resize(360, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            if($instagramRepository->uniqueId($instagram->id)){
               return ['status' => 'Аккаунт с таким id уже отслеживаеться' ,'type'=> 'error'];
            }

            $nameImages = uniqid();
            $path = config('setting.theme-admin')."/images/avatar";
            $fullPatch = $path."/".$nameImages.'.jpg';
            $img->save($fullPatch);
            $instagram->avatar = $fullPatch;


            $client = $this->model->create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'pay_day' => $request->pay_day,

            ]);

            if($client) {

                $client->role()->attach(2);
                $res = $instagramRepository->addInstagramAccount($instagram,$request->category,$client->id, $client->bots);

                if($res) {

                   $data = $this->model->find($client->id);
                   $data->date = date('d-m-Y',strtotime($client->pay_day));
                   $button =  view(config('setting.theme-admin').'.ajax.clientButton')->with('client',$client)->render();
                   $data->html = $button;

                   $data->load('account');

                   return ['status' => 'Аккаунт успешно доваблен!' ,'type'=> 'success', 'data' => json_encode($data)];

                }

                $del = $this->deleteClient($client->id);

                if($del){
                    return ['status' => 'Произошла ошибка при добовлении иснаграмм аккаунта в базу' ,'type'=> 'error'];
                }else{
                        return ['status' => 'Произошла критическая ошибка лучше написать программисту!' ,'type'=> 'error'];
                }
            }
        }
        else{
            return ['status' => 'Не удалось найти аккаунт '.$request->name.'!' ,'type'=> 'error'];
        }

    }

    public function updateClient($request,$id){

        $array = [];

        if(!empty($request->phone)){
            $array = ['name' => $request->name , 'password' => bcrypt($request->password),'phone'=> $request->phone];
        }else{
            $array = ['name' => $request->name , 'password' => bcrypt($request->password)];
        }

        $instagramRepository = new InstagramAccountRepository(new InstagramModelAccount());


        $updateAccount = $instagramRepository->updateClient($id,$request);

        if(!$updateAccount){
            return ['status' => 'Произошла ошибка при обновлении аккаунта '.$request->name ,'type'=> 'error'];
        }

        $update = $this->model->find($id)->fill($array)->update();
        if( $update ) {
            return ['status' => 'Аккаунт '.$request->name.' успешно обновлен!' ,'type'=> 'success'];
        }

        return ['status' => 'Произошла ошибка при обновлении аккаунта '.$request->name ,'type'=> 'error'];
    }


    public function updatePayDayClient($request,$id){
        $array = ['pay_day' => $request->pay_day];

        $update = $this->model->find($id)->fill($array)->update();

        $client = $this->model->find($id);

        $data['date'] = date('d/m/Y',strtotime($client->pay_day));

        if( $update ) {
            return ['status' => 'Дата платежа аккаунта '.$request->name.' успешно обновлена!' ,'type'=> 'success','data' => json_encode($data)];
        }

        return ['status' => 'Произошла ошибка при обновлении даты платежа!' ,'type'=> 'error'];
    }


    public function allClient(){
        $clients = $this->model->whereHas('role', function ($query) {
            $query->where('role_id', '=', '2');
        })->get();
        $clients->load('account');
        return $clients;
    }


    //Удаляем клиента и все что с ним связанно
    public function deleteClient($id)
    {
        $client = $this->model->find($id);
        $client->role()->detach();
        $client->account()->delete();
        if($client->delete()){
            return ['status' => 'Аккаунт успешно удален!' ,'type'=> 'success'];
        }
        return ['status' => 'Произошла ошибка при удалении аккаунта' ,'type'=> 'error'];
    }


    //Получить номера клиентов у которых подошел день оплаты
    public function getPhoneClientPayDay(){

        $readyArray[] = '79819008261';
        $readyArray[] = '79042177096';
        return $readyArray;


        $readyArray = [];

        $dataAssistan = new DataAssistant();
        $nowDay = $dataAssistan::nowDay();
        $res = $this->model->select('id','phone')->where('pay_day',$nowDay)->where('phone','!=',null)->get();
        $res->load('account');

        foreach ($res as $v){
            if($v->account->promotion){
                $readyArray[] = $v->phone;
            }else{
                continue;
            }
        }

        $readyArray[] = '79819008261';
        $readyArray[] = '79042177096';
        return $readyArray;

    }

    //Получить номера клиентов у которых 3 дня до оплаты
    public function getPhoneClientPayThreeDay(){

        $readyArray[] = '79819008261';
        $readyArray[] = '79042177096';
        return $readyArray;

        $readyArray = [];

        $dataAssistan = new DataAssistant();
        $threeDay = $dataAssistan::nextThreeDay();
        $res = $this->model->select('id','phone')->where('pay_day',$threeDay)->where('phone','!=',null)->get();
        $res->load('account');

        foreach ($res as $v){
            if($v->account->promotion){
                $readyArray[] = $v->phone;
            }else{
                continue;
            }
        }

        $readyArray[] = '79819008261';
        $readyArray[] = '79042177096';
        return $readyArray;

    }

}
