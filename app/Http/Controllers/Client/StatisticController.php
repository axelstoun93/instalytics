<?php

namespace App\Http\Controllers\Client;

use App\Config;
use App\Repositories\ConfigRepository;
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

    function __construct()
    {
        parent::__construct( new ClientMenuRepository(new ClientMenu));
        $this->s_rep = new StatisticRepository(new Statistic());
        $this->c_rep = new ConfigRepository(new Config());
        $this->follow_rep = new FollowListRepository(new FollowList());
        $this->unfollow_rep = new UnFollowListRepository(new UnFollowList());
        $this->template = 'statistic';
    }

    public function index()
    {
        $this->page = 'Статистика';

        $client = $this->u_rep->clientInfo(Auth::id());

        $instagramId = $client->account->instagram_id;

        $payCard = $this->c_rep->getPayCard();

        $statistic = $this->s_rep->getTableClient($client->account->instagram_id);

        $follow = $this->follow_rep->getFollowListDay($instagramId);

        $unfollow = $this->unfollow_rep->getUnfollowListDay($instagramId);

        $content = view(config('setting.theme-client').'.statisticContent')->with(['page' => $this->page, 'client' => $client,'statistic' => $statistic,'card' => $payCard,'follow' => $follow,'unfollow' => $unfollow,'followListDate' => $followListDate])->render();
        $this->vars = array_add($this->vars,'content',$content);
        return $this->renderOutput();
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
