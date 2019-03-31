<?php

namespace App\Http\Controllers;

use App\CalendarTask;
use App\InstagramModelAccount;
use App\Proxy;
use App\Repositories\CalendarTaskRepository;
use App\Repositories\InstagramAccountRepository;
use App\Repositories\ProxyRepository;
use App\Repositories\StatisticRepository;
use App\Statistic;
use Illuminate\Http\Request;
use App\Repositories\Assistant\DataAssistant;


class CronController extends Controller
{
    protected $i_rep;
    protected $t_rep;
    protected $s_rep;
    protected $proxy;
    protected $result;

    protected $date;

    protected $arrayUpdateStatus;

    protected $arrayUpdateLogin;


    public function __construct()
    {
        $proxy  = new ProxyRepository(new Proxy());
        $this->proxy = $proxy->getValidateProxy();
        $this->t_rep = new CalendarTaskRepository(new CalendarTask());
        $this->i_rep = new InstagramAccountRepository(new InstagramModelAccount());
        $this->s_rep = new StatisticRepository(new Statistic());

        $this->date = DataAssistant::backDay();

    }

    //Инициализация записываем аккаунты по которым планируем получить данные
    public function init(){

        $allAccount = $this->i_rep->getAllAccount();
        $readyArray = [];

        foreach ($allAccount as $key =>  $v){
            $readyArray[$key]['login'] = $v->login;
            $readyArray[$key]['instagram_id'] = $v->instagram_id;
        }

        $this->t_rep->insert($readyArray);
    }

    public function index()
    {
        $allAccount = $this->t_rep->getOnePart();

        if(!empty($allAccount) and count($allAccount) >= 1){

           $res = $this->multiCurl($allAccount);

           if($res){
               $this->deletePart($allAccount);

               $this->i_rep->updateStatus($this->arrayUpdateStatus);
               $this->i_rep->updateLogin($this->arrayUpdateLogin);

               $this->s_rep->insert($this->result);
           }

        }

    }

    //Удаляем первые записи
    protected function deletePart($allAccount){
        $delete = [];
        foreach ($allAccount as $k => $v){
            $delete[$k]['id'] = $v->id;
        }
        $res = $this->t_rep->deleteOnePart($delete);
        if($res){
            return $res;
        }return false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function multiCurl($data){

            $mh = curl_multi_init();

            $proxyCount = 0;

            $ip = $this->proxy[$proxyCount]->ip;
            $name =   $this->proxy[$proxyCount]->name;
            $password =   $this->proxy[$proxyCount]->password;
            $port =   $this->proxy[$proxyCount]->port;

            $readyArray = [];

            foreach ($data as $key => $value){

                $url = "https://i.instagram.com/api/v1/users/".$value->instagram_id."/info/";



                $multiCurl[$key] = curl_init();
                curl_setopt($multiCurl[$key], CURLOPT_URL, $url);
                curl_setopt($multiCurl[$key], CURLOPT_RETURNTRANSFER, true);
                curl_setopt($multiCurl[$key], CURLOPT_BINARYTRANSFER, true);
                curl_setopt($multiCurl[$key], CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($multiCurl[$key], CURLOPT_PROXYPORT,  $port);
                curl_setopt($multiCurl[$key], CURLOPT_PROXYTYPE, 'HTTP');
                curl_setopt($multiCurl[$key], CURLOPT_PROXY,  $ip );
                curl_setopt($multiCurl[$key], CURLOPT_PROXYUSERPWD, $name.':'.$password);
                curl_multi_add_handle($mh,  $multiCurl[$key]);



                if($key%2 == 0){
                    usleep(600);
                    $proxyCount+= 1;
                    if(empty($this->proxy[$proxyCount])){
                        $proxyCount = 0;
                    }
                }

            }

            $index = null;

            do {
                curl_multi_exec($mh,$index);
            } while($index > 0);

            foreach($multiCurl as $k => $c) {

                $html = curl_multi_getcontent($c);
                $jsonData = json_decode($html);

                //получаем данные
                if(!empty($jsonData->user)){
                    //записываем полученные данные в массив
                    $readyArray[$k] = $jsonData;


                    if($data[$k]->login !==  $jsonData->user->username){
                        $this->arrayUpdateLogin[$k]['login'] = $jsonData->user->username;
                        $this->arrayUpdateLogin[$k]['old_login'] = $data[$k]->login;
                        $this->arrayUpdateLogin[$k]['instagram_id'] =  $jsonData->user->pk;
                    }

                    $this->arrayUpdateStatus[$jsonData->user->pk]['status'] = 1;
                    $this->arrayUpdateStatus[$jsonData->user->pk]['instagram_id'] = $jsonData->user->pk;

                }else{
                    //Меняем статус аккаунта
                    $this->arrayUpdateStatus[$value->instagram_id]['status'] = 0;
                    $this->arrayUpdateStatus[$value->instagram_id]['instagram_id'] = $value->instagram_id;
                }
            }
            curl_multi_close($mh);


            if(!empty($readyArray) and is_array($readyArray)){

                foreach ($readyArray as $key => $value ){
                        $this->result[$key]['follower'] = $value->user->follower_count;
                        $this->result[$key]['following'] = $value->user->following_count;
                        //$this->result[$key]['login'] = $value->user->username;
                        //$this->result[$key]['name'] = $value->user->full_name;
                        $this->result[$key]['instagram_id'] = $value->user->pk;
                        //$this->result[$key]['avatar'] = $value->user->hd_profile_pic_url_info->url;
                        $this->result[$key]['media_count'] = $value->user->media_count;
                        $this->result[$key]['date'] = $this->date;
                }
            }
            return true;
        }

}
