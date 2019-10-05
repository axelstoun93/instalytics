<?php
namespace App\Repositories;

use App\InstagramDonor;

class InstagramDonorRepository extends Repository
{
    function __construct(InstagramDonor $donor)
    {
        $this->model = $donor;
    }

    public function allPaginate(){
        $res =  $this->model->paginate(15);
        return $res;
    }

    public function add($request)
    {

        $arrayReady =[
            'name' => $request->name,
            'password' => $request->password,
            'proxy_id' => $request->proxy ?? null,
            'status' => 1
        ];

        $donor = $this->model->create($arrayReady);

        if($donor) {

            $data = $this->model->find($donor->id);
            $data->ip =  (!empty($data->proxy->ip)) ? $data->proxy->ip : 'Нет';
            $button =  view(config('setting.theme-admin').'.ajax.proxyButton')->with('proxy',$data)->render();
            $data->html = $button;

            return ['status' => 'Донор успешно доваблен!' ,'type'=> 'success', 'data' => json_encode($data)];
        }

        return ['status' => 'Произошла ошибка!','type'=> 'error'];
    }

    //Получаем инстаграм аккаунты которые будут парсить данные
    public function getValidateDonor($countMin){
        $res = $this->model->where('status', 1)->take($countMin)->get();

        if(empty($res)){
            return false;
        }

        $res->load('proxy');
        return $res;
    }

    //Получаем 1 валидный инстаграм аккаунт который будет парсить данные
    public function getFirstValidateDonor(){

        $res = $this->model->where('status', 1)->first();

        if(empty($res)){
            return false;
        }

        $res->load('proxy');
        return $res;

    }


    function updateStatus($id,$status){
        $array = ['status' => $status];
        $donor = $this->model->find($id)->fill($array)->update();
        return $donor;
    }

    function updateDonor($request,$id){
        $array = ['name' => $request->name , 'password' => $request->password,'proxy_id'=> $request->proxy];

        $update = $this->model->find($id)->fill($array)->update();
        if( $update ) {
            return ['status' => 'Аккаунт '.$request->name.' успешно обновлен!' ,'type'=> 'success'];
        }

        return ['status' => 'Произошла ошибка при обновлении донора '.$request->name ,'type'=> 'error'];
    }

    public function delete($id){
        $donor = $this->model->find($id);
        if($donor->delete()) {
            return ['status' => "Донор {$donor->name} успешно удален.",'type'=> 'success'];
        }else
        {
            return ['status' => "Произошла ошибка при удалении прокси",'type'=> 'error'];
        }
    }

}
