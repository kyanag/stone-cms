<?php

namespace App\Models;

use App\Admin\Interfaces\Inspector;
use App\Models\BaseModel as Model;

class ModelForInspector extends Model
{
    /**
     * @var Inspector
     */
    protected $inspector;

    public function withInspector(Inspector $inspector)
    {
        $this->inspector = $inspector;
        return $this;
    }

    public function getTable()
    {
        return $this->inspector->getTableName();
    }


    public function newCollection(array $models = [])
    {
        return parent::newCollection($models)->map(function(ModelForInspector $model){
            return $model->withInspector($this->inspector);
        });
    }

    public function newInstance($attributes = [], $exists = false)
    {
        $model = parent::newInstance($attributes, $exists);
        return $model->withInspector($this->inspector);
    }
}
