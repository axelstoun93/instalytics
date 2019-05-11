<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Repositories\ClientMenuRepository;
use App\ClientMenu;
use App\Repositories\UserRepository;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class SettingController extends ClientController
{
    protected $page;
    protected $u_rep;

    function __construct()
    {
        parent::__construct( new ClientMenuRepository(new ClientMenu));
        $this->u_rep = new UserRepository(new User);
        $this->template = 'setting';
    }

    public function index()
    {
        $this->page = 'Настройки аккаунта';
        $client = $this->u_rep->one(Auth::id());
        $content = view(config('setting.theme-client').'.settingContent')->with(['page' => $this->page,'client' => $client])->render();
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


            if($request->deletePhone){

                $request->phone = null;
                $result = $this->u_rep->updateSetting($request,Auth::id());

                if($result){
                    echo  json_encode($result);
                }
                die;
            }else{

                if(!empty($request->phone)){
                    $request->phone = preg_replace('~\D+~','', $request->phone);
                }


                $validate = Validator::make($request->all(),
                    [
                        'phone' => 'required|unique:users|min:11'
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


                $result = $this->u_rep->updateSetting($request,Auth::id());

                if($result){
                    echo  json_encode($result);
                }

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
        //
    }

    public function addPhone(Request $request){
        if($request->isMethod('post')) {

            if(!empty($request->phone)){
                $request->phone = preg_replace('~\D+~','', $request->phone);
            }


            $validate = Validator::make($request->all(),
                [
                    'phone' => 'required|unique:users|min:11'
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


            $result = $this->u_rep->addPhone($request,Auth::id());

            if($result){
                echo  json_encode($result);
            }

        }
    }

}
