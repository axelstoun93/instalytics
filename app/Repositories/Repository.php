<?php
namespace App\Repositories;
use App\Http\Controllers\Controller;
abstract class Repository extends Controller
{
    protected $model = FALSE;

    function all()
    {
       $result = $this->model->all();
       return $result;
    }

    function one($id){
        $res = $this->model->find($id);
        return $res;
    }

    function first(){
        $res = $this->model->first();
        return $res;
    }

}
