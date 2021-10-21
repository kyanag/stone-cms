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
    use BehaviourTrait;

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

    public function toGridForm(){
        return $this->toForm();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginator(){
        return static::query()->paginate($this->pagesize);
    }

    /**
     * @return Widget
     */
    abstract public function toForm();

    /**
     * @return Widget | Grid
     */
    abstract public function toGrid();


    abstract public function toView();
}