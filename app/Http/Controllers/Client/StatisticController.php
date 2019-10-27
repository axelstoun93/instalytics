<?php

namespace App\Http\Controllers\Client;

use App\Config;
use App\InstagramAccountCheck;
use App\Repositories\Assistant\DataAssistant;
use App\Repositories\ConfigRepository;
use App\Repositories\InstagramAccountCheckRepository;
use Illuminate\Http\Request;
use App\Repositories\ClientMenuRepository;
use App\ClientMenu;
use App\Repositories\StatisticRepository;
use App\Statistic;
use Illuminate\Support\Facades\Auth;
use App\Repositories\FollowListRepository;
use App\Repositories\UnFollowListRepository;
use App\UnFollowList;
use App\FollowList;

class StatisticController extends ClientController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page;
    protected $s_rep;
    protected $c_rep;
    protected $follow_rep;
    protected $unfollow_rep;
    protected $account_check_rep;

    function __construct()
    {
        parent::__construct( new ClientMenuRepository(new ClientMenu));
        $this->s_rep = new StatisticRepository(new Statistic());
        $this->c_rep = new ConfigRepository(new Config());
        $this->follow_rep = new FollowListRepository(new FollowList());
        $this->unfollow_rep = new UnFollowListRepository(new UnFollowList());
        $this->account_check_rep = new InstagramAccountCheckRepository(new InstagramAccountCheck());
        $this->template = 'statistic';
    }

    public function index()
    {
        $this->page = 'Статистика';

        $client = $this->u_rep->clientInfo(Auth::id());

        $instagramId = $client->account->instagram_id;

        $statistic = $this->s_rep->getTableClient($client->account->instagram_id);

        $follow = $this->follow_rep->getFollowListDay($instagramId);

        $unfollow = $this->unfollow_rep->getUnfollowListDay($instagramId);

        $followListDate = $this->follow_rep->getFollowListDate($instagramId);

        $accountFollowersValidate = $this->account_check_rep->getJsonDataById($instagramId);

        $actualInfo = $this->s_rep->getDataLast($instagramId);

        $nowFollower = (!empty($actualInfo)) ? $actualInfo->follower : $client->account->follower;

        $content = view(config('setting.theme-client').'.statisticContent')->with(['page' => $this->page, 'client' => $client,'statistic' => $statistic,'follow' => $follow,'unfollow' => $unfollow,'followListDate' => $followListDate,'accountFollowersValidate' => $accountFollowersValidate,'actualInfo' => $actualInfo,'nowFollower' => $nowFollower])->render();
        $this->vars = array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

    public function checkAccount(){

        $client = $this->u_rep->clientInfo(Auth::id());

        $instagramId = $client->account->instagram_id;

        //Делаем проверку аккаунта

        //Проверяем аккаунт в очереди
        $res = $this->account_check_rep->getByInstagramId($instagramId);

        if(empty($res)){

            $create = $this->account_check_rep->create($instagramId);

            if($create) {
                $status = ['status' => 'Аккаунт поставлен в очередь на проверку!','type'=> 'success'];
            }else {
                $status = ['status' => 'Произошла ошибка!','type'=> 'error'];
            }

            echo  json_encode($status);
            die;
        }elseif(!empty($res) and $res->status === 0){
            $status = ['status' => 'Аккаунт уже стоит в очереди на проверку!','type'=> 'info'];
            echo  json_encode($status);
            die;
        }else{

            //Получем время прошлой проверки
            $oldDateValidate = $res->date;

            //Получаем время следюющей проверки
            $nexDateValidate = DataAssistant::nextDateMonth($oldDateValidate);

            //Получаем unix время следующией проверки;
            $nexDateValidateUnix =  strtotime($nexDateValidate);

            $nexDateRus = DataAssistant::DayAndMountFormatFull($nexDateValidate);

            //Проверяем прошол месяц или нет с момента последней проверки
            if($nexDateValidateUnix  > time()){
                $status = ['status' => "Вы сможете поставить аккаунт на проверку еще раз $nexDateRus г.",'type'=> 'info'];
                echo  json_encode($status);
                die;
            }

            $nowDate = DataAssistant::nowDay();
            $update = $this->account_check_rep->updateByInstagramId($instagramId,['status' => 0,'date' => $nowDate]);
            $status = ['status' => 'Аккаунт поставлен в очередь на проверку!','type'=> 'success'];
            echo  json_encode($status);
            die;
        }


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
}
