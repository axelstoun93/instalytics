<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\StatisticRepository;
use App\Statistic;
use Illuminate\Http\Request;
use App\Repositories\AdminMenuRepository;
use App\AdminMenu;
use App\Repositories\InstagramCategoryRepository;
use App\InstagramAccountCategory;

class IndexController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $s_rep;
    protected $c_rep;

    function __construct()
    {
        parent::__construct( new AdminMenuRepository(new AdminMenu));
        $this->s_rep = new StatisticRepository(new Statistic());
        $this->c_rep = new InstagramCategoryRepository(new InstagramAccountCategory());
        $this->template = 'index';
    }

    public function index(Request $request)
    {

        if(!empty($request->category)){
            $account = $this->s_rep->notificationTable($request->category);
        }else{
            $account = $this->s_rep->notificationTable();
        }

        $category = $this->c_rep->all();
        $content = view(config('setting.theme-admin').'.indexContent')->with(['accounts' => $account,'category' => $category])->render();
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
