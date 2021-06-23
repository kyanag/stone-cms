<?php


namespace App\Admin\Supports;


use App\Admin\Interfaces\Repository;
use Illuminate\Database\Eloquent\Model;

class ModelRepository implements Repository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function find($id){
        return $this->model::query()->find($id);
    }

    public function newModel($attributes){
        $model = clone ($this->model);
        return $model->fill($attributes);
    }

    public function index($keyword = "", $where = []){

    }
}