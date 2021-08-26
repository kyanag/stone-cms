<?php


namespace App\Admin\Supports;


use App\Admin\Interfaces\Repository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ModelRepository implements Repository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function query(){
        return $this->model::query();
    }

    public function index($keyword = null, $params = []){
        return $this->query()->where($params)->get();
    }

    public function find($id){
        return $this->model::query()->find($id);
    }

    /**
     * @param $attributes
     * @return false|Model
     */
    public function create($attributes){
        $modelClass = get_class($this->model);
        /** @var Model $model */
        $model = new $modelClass($attributes);
        return $model->save();
    }

    /**
     * @param Model $model
     * @param array $attributes
     * @return bool
     */
    public function update($model, $attributes){
        $model->fill($attributes);
        return $model->save();
    }

    public function delete($id){
        $model = $this->find($id);
        if(is_null($model)){
            throw new NotFoundHttpException("不存在的内容!");
        }
        return $this->destroy($model);
    }

    protected function destroy($model){
        return $model->delete();
    }

    public function paginate($keyword, $params = [], ...$args){
        return $this->query()->where($params)->paginate(...$args);
    }
}