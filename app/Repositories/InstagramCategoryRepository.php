<?php

namespace App\Repositories;
use App\InstagramAccountCategory;



class InstagramCategoryRepository extends Repository
{
    function __construct(InstagramAccountCategory $category)
    {
        $this->model = $category;
    }


    function one($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function all()
    {
        $result = $this->model->select('id','name')->get();
        return $result;
    }

    function delete($id)
    {
        $category = $this->model->find($id);
        $category->product()->delete();
        if($category->delete()) {
            return ['status' => "Категория {$category->name} успешно удалена.",'alert'=> 'alert alert-success'];
        }else
        {
            return ['status' => "Произошла ошибка при удалении категории",'alert'=> 'alert alert-danger'];
        }
    }

}