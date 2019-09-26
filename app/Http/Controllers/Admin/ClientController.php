<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Assistant\DataAssistant;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\AdminMenuRepository;
use App\AdminMenu;
use Validator;
use Illuminate\Validation\Rule;
use App\Repositories\InstagramCategoryRepository;
use App\InstagramAccountCategory;

class ClientController extends AdminController
{
    protected $page;
    protected $u_rep;
    protected $c_rep;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        parent::__construct( new AdminMenuRepository(new AdminMenu));
        $this->u_rep = new UserRepository(new User());
        $this->c_rep = new InstagramCategoryRepository(new InstagramAccountCategory());
        $this->template = 'client';
    }

    public function index(){
        $this->page = 'Клиенты';
        $clients = $this->u_rep->allClient();
        $category = $this->c_rep->all();
        $content = view(config('setting.theme-admin').'.clientTable')->with(['page' => $this->page,'clients' => $clients,'category' => $category])->render();
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

            //устанавливаем дефолтный пароль
            if(empty($request->password)){
                $request->password = config('setting.default-password');
            }

            if(!empty($request->phone)){
                $request->phone = preg_replace('~\D+~','', $request->phone);
            }


            $validate = Validator::make($request->all(),
                [
                     'name' => 'required|unique:users',
                     'phone' => (!empty($request->phone)) ? 'required|unique:users|min:11': '',
                     'pay_day' => 'required',
                     'password' => 'min:6|max:255',
                     'category' => 'required|integer',
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

            $result = $this->u_rep->addClient($request);

            if($result){
                echo  json_encode($result);
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

        if(empty($request->password)){

            $request->password = config('setting.default-password');
        }

        if(!empty($request->phone)){
            $request->phone = preg_replace('~\D+~','', $request->phone);
        }

        if($request->isMethod('put')) {

            $validate = Validator::make($request->all(),
                [
                    'name' => ['required',
                        Rule::unique('users')->ignore($id),
                    ],
                    'phone' => (!empty($request->phone)) ? 'required|unique:users|min:11': '',
                    'promotion'=> 'required|integer'
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
            $result = $this->u_rep->updateClient($request,$id);
            if($result){
                echo  json_encode($result);
            }
        }
    }


    public function payDayUpdate(Request $request, $id)
    {
        if($request->isMethod('put')) {

            $validate = Validator::make($request->all(),
                [
                    'pay_day'=> 'required',
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
            $result = $this->u_rep->updatePayDayClient($request,$id);
            if($result){
                echo  json_encode($result);
            }
        }
    }


    //Дата правок
    public function editDayUpdate(Request $request, $id)
    {
        if($request->isMethod('post')) {

            $validate = Validator::make($request->all(),
                [
                    'edit_day'=> 'required',
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
            $result = $this->u_rep->updateEditDayClient($request,$id);
            if($result){
                echo  json_encode($result);
            }
        }
    }



    //Дата публикации
    public function publicDayUpdate(Request $request, $id)
    {
        if($request->isMethod('post')) {

            $validate = Validator::make($request->all(),
                [
                    'public_day'=> 'required',
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
            $result = $this->u_rep->updatePublicDayClient($request,$id);
            if($result){
                echo  json_encode($result);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->u_rep->deleteClient($id);
        echo json_encode($result);
    }
}
