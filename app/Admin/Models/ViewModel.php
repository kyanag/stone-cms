<?php


namespace App\Admin\Models;


use App\Admin\Widgets\Form;
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

    protected $pageSize = 10;


    public function showTitle(){
        return class_basename(static::class);
    }

    public function showDescription(){
        return $this->_description;
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
        return static::query()->paginate($this->pageSize);
    }

    /**
     * @return Form
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
        return $this->toForm()->withAttribute("submitText", "搜索");
    }

    public function toView(){
        return $this->toForm();
    }

    public static function newModel(){
        return new static();
    }
}