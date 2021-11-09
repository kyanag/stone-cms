<?php


namespace App\Admin\Models;


use App\Admin\Widgets\Form;
use App\Admin\Widgets\Grid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
        return $this->showTitle();
    }


    public function fillForFilter($attributes = []){
        $this->fill($attributes);
    }

    public function fillForForm($attributes = []){
        $this->fill($attributes);
    }

    /**
     * @param array $attributes
     * @throws ValidationException
     */
    public function fillForSave($attributes = []){
        $attributes = $this->validate($attributes);
        $this->fill($attributes);
    }

    /**
     * @param $attributes
     * @return array
     * @throws ValidationException
     */
    public function validate($attributes){
        $keys = array_map(function($child){
            return $child->getName();
        }, $this->toForm()->getChildren());
        return collect($attributes)->only($keys)->toArray();
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
