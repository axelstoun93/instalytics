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

    function __construct()
    {
        parent::__construct( new ClientMenuRepository(new ClientMenu));
        $this->s_rep = new StatisticRepository(new Statistic());
        $this->c_rep = new ConfigRepository(new Config());
        $this->template = 'statistic';
    }

    public function index()
    {
        $this->page = 'Статистика';

        $client = $this->u_rep->clientInfo(Auth::id());

        $payCard = $this->c_rep->getPayCard();

        $statistic = $this->s_rep->getTableClient($client->account->instagram_id);

        $content = view(config('setting.theme-client').'.statisticContent')->with(['page' => $this->page, 'client' => $client,'statistic' => $statistic,'card' => $payCard])->render();
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
