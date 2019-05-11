<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Repositories\ClientMenuRepository;
use App\ClientMenu;

class PoliceController extends ClientController
{
    protected $s_rep;
    protected $page;

    function __construct()
    {
        parent::__construct( new ClientMenuRepository(new ClientMenu));
        $this->template = 'police';
    }


    public function index()
    {
        $this->page = 'Политика обработки персональных данных';

        $content = view(config('setting.theme-client').'.policeContent')->with(['page' => $this->page])->render();
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
