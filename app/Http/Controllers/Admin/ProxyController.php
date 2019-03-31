<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\ProxyRepository;
use App\Repositories\AdminMenuRepository;
use App\Proxy;
use App\AdminMenu;
use Validator;

class ProxyController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $p_rep;
    protected $page;

    function __construct()
    {
        parent::__construct(new AdminMenuRepository(new AdminMenu));
        $this->p_rep = new ProxyRepository(new Proxy());
        $this->template = 'proxy';
    }

    public function index()
    {
        $this->page = 'Прокси';
        $proxy = $this->p_rep->all();
        $content = view(config('setting.theme-admin').'.proxyTable')->with(['page' => $this->page,'proxy' => $proxy])->render();
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
        if($request->isMethod('post')) {
            $validate = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'password' => 'required',
                    'port' => 'required|integer',
                    'ip' => 'required|ip'
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

            $proxyStatus = $this->p_rep->proxyGetStatus($request->name,$request->password,$request->ip,$request->port);

            if(!$proxyStatus){
                $error[0] = ['status' => 'Прокси сервер не отвечает!' ,'type'=> 'error'];
                echo json_encode($error);
                die;
            }else{
                $res = $this->p_rep->add($request);
                echo json_encode($res);
            }

        }
    }

    public function statusProxy(Request $request)
    {
        if($request->isMethod('post')) {
        $proxy = $this->p_rep->one($request->id);
        $validProxy = $this->p_rep->proxyGetStatus($proxy->name,$proxy->password,$proxy->ip,$proxy->port);

            if($validProxy) {
                $result = ['status' => 'Прокси '.$proxy->name.' активен','type'=> 'success'];
                $res = $this->p_rep->updateStatus($request->id,1);
                echo json_encode($result);
                die;
            }else {
                $result = ['status' => 'Прокси '.$proxy->name.' не активен','type'=> 'error'];
                $res = $this->p_rep->updateStatus($request->id,0);
                echo json_encode($result);
                die;
            }
        }
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
        $result = $this->p_rep->delete($id);
        echo json_encode($result);
    }
}
