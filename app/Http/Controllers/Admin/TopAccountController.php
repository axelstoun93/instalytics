<?php

namespace App\Http\Controllers\Admin;

use App\Statistic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AdminMenuRepository;
use App\AdminMenu;
use App\Repositories\StatisticRepository;
use App\Repositories\InstagramCategoryRepository;
use App\InstagramAccountCategory;

class TopAccountController extends AdminController
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
        $this->template = 'top';
    }

    public function index(Request $request)
    {
        $oldDate = \Carbon\Carbon::today()->subDays(32)->format('Y-m-d');
        $nowDate = \Carbon\Carbon::today()->subDays(1)->format('Y-m-d');

        if(!empty($request->start_date) and !empty($request->end_date)){
            $account = $this->s_rep->growthTable($request->start_date,$request->end_date,$request->category);
        }else{
            $account = $this->s_rep->growthTable($oldDate,$nowDate,$request->category);
        }


        $category = $this->c_rep->all();

        $content = view(config('setting.theme-admin').'.topContent')->with(['accounts' => $account,'category' => $category,'oldDate' => $oldDate,'nowDate' => $nowDate])->render();
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
