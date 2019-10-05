<?php

namespace App\Http\Controllers;

use App\CalendarAndroidTask;
use App\CalendarTask;
use App\FollowerUserList;
use App\InstagramAccount as InstagramModelAccount;
use App\Proxy;
use App\Repositories\CalendarAndroidTaskRepository;
use App\Repositories\CalendarTaskRepository;
use App\Repositories\InstagramAccountRepository;
use App\Repositories\ProxyRepository;
use App\Repositories\StatisticRepository;
use App\Statistic;
use Illuminate\Http\Request;
use App\Repositories\Assistant\DataAssistant;
use App\Repositories\InstagramDonorRepository;
use App\InstagramDonor;
use App\Repositories\Api\InstagramAndroidApi;
use App\Repositories\FollowerUserListRepository;

class CronController extends Controller
{
    protected $i_rep;
    protected $task_rep;
    protected $donor_rep;
    protected $task_android_rep;
    protected $follower_list_rep;
    protected $s_rep;
    protected $proxy;

    protected $arrayUpdateStatus;

    protected $arrayUpdateLogin;

    public function __construct()
    {
        $proxy  = new ProxyRepository(new Proxy());

        $this->proxy = $proxy->getValidateProxy();
        $this->task_rep = new CalendarTaskRepository(new CalendarTask());
        $this->task_android_rep = new CalendarAndroidTaskRepository(new CalendarAndroidTask());
        $this->i_rep = new InstagramAccountRepository(new InstagramModelAccount());
        $this->s_rep = new StatisticRepository(new Statistic());
        $this->follower_list_rep = new FollowerUserListRepository(new FollowerUserList());
        $this->donor_rep = new InstagramDonorRepository(new InstagramDonor());

    }

    //Инициализация записываем аккаунты по которым планируем получить данные
    public function init(){

        $allAccount = $this->i_rep->getCurrentAccount();

        //Получаем аккаунты у которых подписок <= 30000
        $limitAccount = $this->i_rep->getCurrentAccountLimitFollower(30000);

        $readyAllArray = [];

        $readyAllLimitArray = [];

        foreach ($allAccount as $key =>  $v){
            $readyAllArray[$key]['login'] = $v->login;
            $readyAllArray[$key]['instagram_id'] = $v->instagram_id;
        }

        //Отчищяем список если были проблемы при получении данных
        $this->task_rep->deleteAllAccount();

        //Записываем новые данные по которым будем получать данны
        $this->task_rep->insert($readyAllArray);

        foreach ($limitAccount as $key =>  $v){
            $readyAllLimitArray[$key]['login'] = $v->login;
            $readyAllLimitArray[$key]['instagram_id'] = $v->instagram_id;
        }

        //Отчищяем список если были проблемы при получении данных
        $this->task_android_rep->deleteAllAccount();

        //Записываем новые данные по которым будем получать данны
        $this->task_android_rep->insert($readyAllLimitArray);
    }

    //Старый метод получения данных по аккаунту
    public function getTask(){

        //Если список пуст нечего не делаем
        if($this->task_rep->isEmpty()){
            return false;
        }


        //Получаем первую партию аккаунтов
        $allAccount = $this->task_rep->getOnePart();

        if(!empty($allAccount) and count($allAccount) >= 1){

           $res = $this->multiCurl($allAccount);

           if($res){
               $this->deletePartTask($allAccount);

               $this->i_rep->updateStatus($this->arrayUpdateStatus);
               $this->i_rep->updateLogin($this->arrayUpdateLogin);

               $this->s_rep->insert($res);
           }
        }else{
            echo  'Пусто!';
        }

    }

    public function getTaskNew(){

        //Если список пуст нечего не делаем
        if($this->task_rep->isEmpty()){
            return false;
        }

        //Получаем аккаунты который будет парсить данные в данном случае получаем 3 аккаунта за 1 раз
        $allValidateDonor = $this->donor_rep->getValidateDonor(3);

        $backDay =  DataAssistant::backDay();

        $instagramId = '';
        $instagramLogin = '';

        $readyArray = [];

        try{
            foreach ($allValidateDonor as $donor){

                //Получаем первую партию аккаунтов
                $allAccount = $this->task_rep->getOnePart();

                if(!empty($allAccount) and count($allAccount) >= 1){

                    if(empty($donor)){
                        break;
                    }

                    $readyArray = [];

                    $androidAPI = InstagramAndroidApi::getInstance($donor);

                    $instagramId = '';
                    $instagramLogin = '';

                    foreach ($allAccount as $k => $v){

                        $instagramId = $v->instagram_id;
                        $instagramLogin = $v->login;

                        $account = $androidAPI->getInfoUserById($v->instagram_id);
                        $nowLogin = $account->getUsername();

                        if($instagramLogin !== $nowLogin){
                            $this->arrayUpdateLogin[$k]['login'] = $nowLogin;
                            $this->arrayUpdateLogin[$k]['old_login'] = $instagramLogin;
                            $this->arrayUpdateLogin[$k]['instagram_id'] = $instagramId;
                        }

                        $this->arrayUpdateStatus[$v->instagram_id]['status'] = 1;
                        $this->arrayUpdateStatus[$v->instagram_id]['instagram_id'] = $instagramId;

                        $account = $androidAPI->getInfoUserById($v->instagram_id);
                        $readyArray[$k]['follower'] = $account->getFollowerCount();
                        $readyArray[$k]['following'] = $account->getFollowingCount();
                        $readyArray[$k]['instagram_id'] = $v->instagram_id;
                        $readyArray[$k]['media_count'] = $account->getMediaCount();
                        $readyArray[$k]['date'] = $backDay;

                    }


                    $this->deletePartTask($allAccount);

                    $this->i_rep->updateStatus($this->arrayUpdateStatus);
                    $this->i_rep->updateLogin($this->arrayUpdateLogin);

                    $this->s_rep->insert($readyArray);

                } else{
                    //echo  'Пусто!';
                    break;
                }}}catch (\Exception $e){
                    //Если получили 404
                       if($e->getMessage() === 'Requested resource does not exist.'){
                           //Обновляем статус у инстаграм аккаунта он больше не аквтиен
                           $this->arrayUpdateStatus[$instagramId]['status'] = 0;
                           $this->arrayUpdateStatus[$instagramId]['instagram_id'] = $instagramId;
                           $this->i_rep->updateStatus($this->arrayUpdateStatus);
                           //Записываем данные по аккаунтам которые уже получили статистику
                           $this->s_rep->insert($readyArray);
                           // если получили ошибку по аккаунту удаляем его из списка что бы больше его не дергать
                           $taskRepositoryList = $this->task_rep->deleteTaskByInstagramId($instagramId);
                        }
                       echo $e->getMessage();
        }



    }

    public function getAndroidTask(){

        //Если список пуст нечего не делаем
        if($this->task_android_rep->isEmpty()){
            return false;
        }

        $backDay =  DataAssistant::backDay();

        //Проверяем парсинг данных закончен или нет
        $allAccount = $this->task_rep->isEmpty();

        //если не закончили ждем пока закончит
        if(!$allAccount){
            //echo  'Скрипт небыл запущен';
            die;
        }


        //Получаем аккаунты который будет парсить данные в данном случае получаем 3 аккаунта за 1 раз
        $allValidateDonor = $this->donor_rep->getValidateDonor(3);
        try{
        foreach ($allValidateDonor as $donor){

            //Получаем аккаунт по которому будем получть данные
            $allAndroidAccount = $this->task_android_rep->getOnePart();

        if(!empty($allAndroidAccount) and count($allAndroidAccount) >= 1){

                if(empty($donor)){
                    break;
                }

                $readyArray = [];

                $androidAPI = InstagramAndroidApi::getInstance($donor);

                $status = true;

                foreach ($allAndroidAccount as $v){

                    $instagramId = $v->instagram_id;
                    $instagramLogin = $v->login;


                    $followers = $androidAPI->getFollowers($instagramId);

                    foreach ($followers as $key => $item){
                        $readyArray[$key]['login'] = $item->getUsername();
                        $readyArray[$key]['instagram_id'] = $instagramId;
                        $readyArray[$key]['follower_instagram_id'] = $item->getPk();
                        $readyArray[$key]['follower'] = null;
                        $readyArray[$key]['following'] = null;
                        $readyArray[$key]['date'] = $backDay;
                    }

                    $status = $this->follower_list_rep->insert($readyArray);

                    $nowFollower = $androidAPI->getCountFollowers($instagramId);

                    $this->follower_list_rep->getDataFollowUnFollow($v->instagram_id,$nowFollower);

                }

                $this->deletePartAndroidTask($allAndroidAccount);

            } else{
                //echo  'Пусто!';
                break;
        }}}catch (\Exception $e){
            if($e->getMessage() === 'Requested resource does not exist.'){
                $res = $this->task_android_rep ->deleteFirstAccount();
            }
            echo $e->getMessage();
        }
    }

    //Удаляем первые записи задачи
    protected function deletePartTask($allAccount){
        $delete = [];
        foreach ($allAccount as $k => $v){
            $delete[$k]['id'] = $v->id;
        }
        $res = $this->task_rep->deleteOnePart($delete);
        if($res){
            return $res;
        }return false;
    }

    //Удаляем первые записи задачи андройд
    protected function deletePartAndroidTask($allAccount){
        $delete = [];
        foreach ($allAccount as $k => $v){
            $delete[$k]['id'] = $v->id;
        }
        $res = $this->task_android_rep->deleteOnePart($delete);
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

                $url = "https://www.instagram.com/".$value->login."/";

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

                $findData = preg_match('/window._sharedData\s*=(.+)(?=;|<\}\}\;)/', strip_tags($html), $get_json_data);

                if(!empty($get_json_data)){
                    $jsonData = json_decode($get_json_data[1],true);
                }else{
                    $jsonData = false;
                }

                //получаем данные
                if(!empty($jsonData["entry_data"])){

                    //записываем полученные данные в массив
                    $readyArray[$k] = $jsonData;

                    //Проверяем сменил логин или нет
                    if($data[$k]->login !== $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]['username']){
                        $this->arrayUpdateLogin[$k]['login'] = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]['username'];
                        $this->arrayUpdateLogin[$k]['old_login'] = $data[$k]->login;
                        $this->arrayUpdateLogin[$k]['instagram_id'] = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]['id'];
                    }

                    $this->arrayUpdateStatus[$data[$k]->instagram_id]['status'] = 1;
                    $this->arrayUpdateStatus[$data[$k]->instagram_id]['instagram_id'] = $jsonData["entry_data"]["ProfilePage"][0]["graphql"]["user"]['id'];

                }else{
                    //Меняем статус аккаунта
                    $this->arrayUpdateStatus[$data[$k]->instagram_id]['status'] = 0;
                    $this->arrayUpdateStatus[$data[$k]->instagram_id]['instagram_id'] = $data[$k]->instagram_id;
                }
            }

            curl_multi_close($mh);

            $arrayDb = [];

            $backDay =  DataAssistant::backDay();

            if(!empty($readyArray) and is_array($readyArray)){

                foreach ($readyArray as $key => $value ){
                        $arrayDb[$key]['follower'] = $value["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_followed_by"]["count"];
                        $arrayDb[$key]['following'] = $value["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_follow"]["count"];
                        //$this->result[$key]['login'] = $value->user->username;
                        //$this->result[$key]['name'] = $value->user->full_name;
                        $arrayDb[$key]['instagram_id'] = $value["entry_data"]["ProfilePage"][0]["graphql"]["user"]['id'];
                        //$this->result[$key]['avatar'] = $value->user->hd_profile_pic_url_info->url;
                        $arrayDb[$key]['media_count'] = $value["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]['count'];
                        $arrayDb[$key]['date'] = $backDay;
                }

            }
            return $arrayDb;
        }


     //Удаляем не нужные данные из таблицы
    public function clearFollowerUserList(){
        $treeDay = DataAssistant::backThreeDay();
        $res = $this->follower_list_rep->deleteBackDate($treeDay);
        if($res){
            return true;
        }else{
            return false;
        }

    }

}



