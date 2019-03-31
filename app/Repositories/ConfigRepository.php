<?php
namespace App\Repositories;

use App\Config;

class ConfigRepository extends Repository
{
    function __construct(Config $proxy)
    {
        $this->model = $proxy;
    }

    function updateStatus($id,$status)
    {
        $array = ['status' => $status];
        $setting = $this->model->find($id)->fill($array)->update();
        return $setting;
    }

    function all()
    {
        $ready = [];
        $result =  $this->model->all();

        foreach ($result as $v){
            $ready[$v->name]['value'] = $v->value;
            $ready[$v->name]['class'] = $v->class;
        }

        return $ready;
    }

    function updateConfig($array){

            foreach ($array as $k => $v){

                if($k == '_token'){
                    continue;
                }

              $this->model->where('name',$k)->update(['value' => $v]);

            }

            $data = $this->model->all();

            return ['status' => 'Конфигурации успешно обновлены!' ,'type'=> 'success','data' => json_encode($data)];

    }


    function getPayCard(){
        $res = $this->model->where('name','card')->first();
        return $res;
    }


}