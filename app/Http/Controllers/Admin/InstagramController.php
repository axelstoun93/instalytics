<?php

namespace App\Http\Controllers\Admin;

use App\InstagramModelAccount;
use Illuminate\Http\Request;
use App\Repositories\AdminMenuRepository;
use App\Repositories\InstagramAccountRepository;
use App\AdminMenu;
use App\Repositories\StatisticRepository;
use App\Statistic;
use App\Repositories\InstagramCategoryRepository;
use App\InstagramAccountCategory;


class InstagramController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page;
    protected $a_rep;
    protected $s_rep;
    protected $c_rep;


    function __construct()
    {
        parent::__construct(new AdminMenuRepository(new AdminMenu));
        $this->a_rep = new InstagramAccountRepository(new InstagramModelAccount());
        $this->s_rep = new StatisticRepository(new Statistic());
        $this->c_rep = new InstagramCategoryRepository(new InstagramAccountCategory());
        $this->template = 'instagram';
    }

    public function index(Request $request)
    {
        $this->page = 'Аккаунты';

        if(!empty($request->category)){
            $accounts = $this->a_rep->getCurrentAccountandCategory($request->category);
        }else{
            $accounts = $this->a_rep->all();
        }

        $category = $this->c_rep->all();
        $content = view(config('setting.theme-admin').'.instagramTable')->with(['page' => $this->page,'accounts' => $accounts,'category' => $category])->render();
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
        $this->page = 'Статистика';

        $client = $this->u_rep->clientInfo($id);
        $category = $this->c_rep->all();

        $statistic = $this->s_rep->getTable($client->account->instagram_id);
        $clientStatistic = $this->s_rep->getTableClient($client->account->instagram_id);

        $info = $this->s_rep->getDataLast($client->account->instagram_id);

        $content = view(config('setting.theme-admin').'.instagramShow')->with(['page' => $this->page, 'client' => $client,'statistic' => $statistic,'clientStatistic' => $clientStatistic ,'info' => $info])->render();
        $this->vars = array_add($this->vars,'content',$content);
        return $this->renderOutput();
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
