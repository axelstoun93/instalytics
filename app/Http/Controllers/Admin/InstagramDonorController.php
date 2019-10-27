<?php

namespace App\Http\Controllers\Admin;

use App\InstagramDonor;
use App\Repositories\InstagramDonorRepository;
use Illuminate\Http\Request;
use App\Repositories\ProxyRepository;
use App\Repositories\AdminMenuRepository;
use App\Proxy;
use App\AdminMenu;
use App\Repositories\Api\InstagramAndroidApi;
use Validator;
use Illuminate\Validation\Rule;

class InstagramDonorController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $p_rep;
    private $d_rep;
    protected $page;

    function __construct()
    {
        parent::__construct(new AdminMenuRepository(new AdminMenu));
        $this->p_rep = new ProxyRepository(new Proxy());
        $this->d_rep = new InstagramDonorRepository(new InstagramDonor());
        $this->template = 'donor';
    }

    public function index()
    {
        $this->page = 'Прокси';
        $proxy = $this->p_rep->getValidateProxy();
        $donor = $this->d_rep->all();
        $content = view(config('setting.theme-admin').'.donorTable')->with(['page' => $this->page,'proxy' => $proxy,'donor' => $donor])->render();
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
                    'password' => 'required'
                ]);


            if($validate->fails()) {
                $error = [];
                $response = $validate->messages();
                foreach ($response->all() as $key => $value)
                {
                    $error[$key] = ['status' => $value ,'type'=> 'error'];
                }
                echo  json_encode($error);
                die;
            }

                $res = $this->d_rep->add($request);
                echo json_encode($res);
        }
    }

    public function statusDonor(Request $request)
    {
        if($request->isMethod('post')) {
            $donor = $this->d_rep->one($request->id);
            $result = ['status' => 'Донор '.$donor->name.' активен','type'=> 'success'];
            try {

                $androidAPI = new InstagramAndroidApi($donor);
                $androidAPI->getIdByLogin($donor->name);
                $this->d_rep->updateStatus($request->id,1);
                $androidAPI->__destruct();

                echo json_encode($result);
                die;

            }catch (\Exception $e){
                echo $e->getMessage();
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

        if($request->isMethod('put')) {

            $validate = Validator::make($request->all(),
                [
                    'name' => ['required',
                        Rule::unique('instagram_donor')->ignore($id),
                    ],
                    'password' => (!empty($request->password)) ? 'required' : '',
                    'proxy'=> (!empty($request->proxy)) ? 'required|integer': '',
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
            $result = $this->d_rep->updateDonor($request,$id);
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
        $result = $this->d_rep->delete($id);
        echo json_encode($result);
    }
}
