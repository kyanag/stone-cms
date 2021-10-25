<?php


namespace App\Admin\Models;


use App\Admin\Extendeds\BehaviourTrait;
use App\Admin\Widgets\Grid;
use Illuminate\Database\Eloquent\Model;
use Kyanag\Form\Core\Widget;

/**
 * Trait ViewModel
 * @package App\Admin\Models
 * @mixin Model
 */
trait ViewModel
{

    protected $pagesize = 10;

    public function showTitle(){
        return $this->exists ? "添加" : "修改";
    }

    public function showDescription(){
        return null;
    }

    public function fillForFilter($attributes = []){
        $this->fill($attributes);
    }

    public function fillForCreate($attributes = []){
        $this->fill($attributes);
    }

    public function fillForUpdate($attributes = []){
        $this->fill($attributes);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginator(){
        return static::query()->paginate($this->pagesize);
    }

    /**
     * @return Widget
     * @throws \Exception
     */
    public function toForm(){
        $class = static::class;
        throw new \Exception("{$class}::toForm not exists!");
    }

    /**
     * @return Widget | Grid
     */
    public function toGrid(){
        $class = static::class;
        throw new \Exception("{$class}::toGrid not exists!");
    }

    public function toGridForm(){
        return $this->toForm();
    }

    public function toView(){
        return $this->toForm();
    }
}