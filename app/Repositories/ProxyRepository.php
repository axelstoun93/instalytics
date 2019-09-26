<?php
namespace App\Repositories;

use App\Proxy;

class ProxyRepository extends Repository
{
    function __construct(Proxy $proxy)
    {
        $this->model = $proxy;
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
            'ip' => $request->ip,
            'port' => $request->port,
            'status' => 1
        ];

        $proxy = $this->model->create($arrayReady);

        if($proxy) {

            $data = $this->model->find($proxy->id);
            $button =  view(config('setting.theme-admin').'.ajax.proxyButton')->with('proxy',$data)->render();
            $data->html = $button;

            return ['status' => 'Прокси успешно доваблен!' ,'type'=> 'success', 'data' => json_encode($data)];
        }

        return ['status' => 'Произошла ошибка!','type'=> 'error'];
    }

    public function getValidateProxy()
    {
        $res = $this->model->where('status', 1)->get();
        return $res;
    }

    public function getValidateProxyFirst()
    {
        $res = $this->model->where('status', 1)->first();
        return $res;
    }

    function proxyGetStatus($login,$password,$ip,$port){

        $ch = curl_init();
        $url = 'https://www.google.com';
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_PROXYPORT, $port);
        curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
        curl_setopt($ch, CURLOPT_PROXY, $ip);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $login.':'.$password);
        $html = curl_exec($ch);
        curl_close($ch);
        if($html) {
            return true;
        }return false;
    }

    function updateStatus($id,$status)
    {
        $array = ['status' => $status];
        $setting = $this->model->find($id)->fill($array)->update();
        return $setting;
    }



    public function delete($id){
        $proxy = $this->model->find($id);

        $donors = $proxy->donors()->get();

        if(!empty($donors)){
            $name = [];
            foreach ($proxy->donors()->select('name')->get() as $v){
                $name[] = $v->name;
            }
            $donorList = implode(',',$name);
            return ['status' => "Перед удалением этого прокси нужно отвязать от него доноров ($donorList)",'type'=> 'error'];
            die;
        }

        if($proxy->delete()) {
            return ['status' => "Прокси {$proxy->name} успешно удален.",'type'=> 'success'];
        }else
        {
            return ['status' => "Произошла ошибка при удалении прокси",'type'=> 'error'];
        }
    }
}