<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Repositories\SiteMenuRepository;
use App\SiteMenu;

class ProjectController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->title = 'О проекте | Честный сервис instagram статистики datalytics.pro';
        $this->keywords = 'Детальная статистика instagram аккаунта,статистика instagram аккаунту,instagram статистика';
        $this->description = 'Контролируйте приросты и оттоки аудитории, проверьте аккаунт на ботов, получайте ежедневные списки, кто подписался и отписался от вас с уникальным сервисом datalytics.pro. Зарегистрируйтесь и получите 5 дней бесплатно!';
        parent::__construct(new SiteMenuRepository(new SiteMenu()));
        $this->template = 'project';
    }

    public function index()
    {
        $this->vars = array_add($this->vars,'content','');
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
