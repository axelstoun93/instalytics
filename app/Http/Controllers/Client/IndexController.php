<?php

namespace App\Http\Controllers\Client;

use App\Repositories\ClientMenuRepository;
use App\ClientMenu;
use App\Repositories\StatisticRepository;
use App\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends ClientController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $s_rep;

    function __construct()
    {
        parent::__construct( new ClientMenuRepository(new ClientMenu));
        $this->s_rep = new StatisticRepository(new Statistic());
        $this->template = 'index';
    }

    public function index()
    {
        $client = $this->u_rep->clientInfo(Auth::id());
        $info = $this->s_rep->getDataLast($client->account->instagram_id);
        $content = view(config('setting.theme-client').'.indexContent')->with(['client' => $client,'info' => $info])->render();
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
