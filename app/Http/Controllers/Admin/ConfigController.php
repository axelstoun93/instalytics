<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use App\Repositories\ConfigRepository;
use Illuminate\Http\Request;
use App\Repositories\AdminMenuRepository;
use Validator;
use App\AdminMenu;

class ConfigController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $c_rep;
    protected $page;

    function __construct()
    {
        parent::__construct( new AdminMenuRepository(new AdminMenu));
        $this->c_rep = new ConfigRepository(new Config());
        $this->template = 'config';
    }

    public function index()
    {
        $this->page = 'Общие настройки';
        $allConfig = $this->c_rep->all();
        $content = view(config('setting.theme-admin').'.configTable')->with(['page' => $this->page,'config' => $allConfig ])->render();
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

        if(!empty($request->card)){
            $request->card = preg_replace('![^0-9]+!','', $request->card);
        }

        $validate = Validator::make($request->all(),
            [
                'card' => 'required|min:16|max:20',
            ]);

        if($validate->fails())
        {
            $error = [];
            $response = $validate->messages();
            foreach ($response->all() as $key => $value)
            {
                $error[$key] = ['status' => $value ,'type'=> 'error'];
            }
            echo  json_encode($error);
            die;
        }

        $res = $this->c_rep->updateConfig($request->all());
        echo  json_encode($res);

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
