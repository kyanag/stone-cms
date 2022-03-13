<?php


namespace App\Admin\ModelProxies;


use App\Admin\Interfaces\ModelProxy as IModelProxy;
use App\Admin\Supports\Factory;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class ModelProxy implements IModelProxy
{

    /**
     * 模型class
     * @var string
     */
    protected $modelClass;

    /**
     * @var Model
     */
    protected $record;


    public function __construct($record = null)
    {
        if(!$record){
            $record = $this->newRecord();
        }
        $this->record = $record;
    }


    public function getRecord()
    {
        return $this->record;
    }

    public function withRecord($record)
    {
        if(is_numeric($record) or is_string($record)){
            $record = $this->newQuery()->findOrFail($record);
        }
        $this->record = $record;
        return $this;
    }

    public function fill(array $attributes)
    {
        $record = $this->getRecord();
        $record->fill($attributes);

        return $this;
    }


    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getPaginator()
    {
        return $this->newQuery()->paginate();
    }


    protected function newRecord()
    {
        $class = $this->modelClass;
        return new $class;
    }

    /**
     * @return Builder
     */
    protected function newQuery()
    {
        return $this->record->newQuery();
    }

    public function save()
    {
        return $this->record->save();
    }

    public function delete()
    {
        return $this->record->delete();
    }
}
