<?php


namespace App\Admin\Supports;


use App\Admin\Widgets\Form;
use App\Admin\Widgets\Grid;
use App\Admin\Widgets\Grids\GeneralGrid;
use Illuminate\Http\Request;
use Kyanag\Form\Core\Widget;
use function Kyanag\Form\createWidget;

class Factory
{

    static protected $instances = [];

    public static function instance($id, $creator){
        if(!isset(static::$instances[$id])){
            static::$instances[$id] = call_user_func($creator);
        }
        return static::$instances[$id];
    }

    public static function createWidget($props){
        return createWidget($props);
    }

    public static function createElement($name, array $properties = [], $children = []){
        return new Widget($name, $properties, $children);
    }


    public static function createFormElement($name, array $properties = [], $children = []){
        return new Form($name, $properties, $children);
    }

    public static function createGrid($name, $properties = [], $children = []){
        return new Grid("grid", $properties, $children);
    }

    public static function createColumn($column){

    }

    protected static function setProperties($object, $properties = []){
        foreach ($properties as $name => $value){
            $object->{$name} = $value;
        }
    }

}
