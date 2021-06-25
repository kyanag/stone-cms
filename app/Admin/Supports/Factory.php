<?php


namespace App\Admin\Supports;


use App\Admin\Widgets\Forms\GeneralForm;
use App\Admin\Widgets\Grids\GeneralGrid;
use Illuminate\Http\Request;
use Kyanag\Form\Core\ArrayElement;
use Kyanag\Form\Interfaces\Element;

class Factory
{

    static protected $instances = [];

    public static function instance($id, $creator){
        if(!isset(static::$instances[$id])){
            static::$instances[$id] = call_user_func($creator);
        }
        return static::$instances[$id];
    }

    /**
     * @param array $item
     * @return Element
     */
    public static function makeField($item){
        if($item instanceof Element){
            return $item;
        }
        if(isset($item['options']) && is_array($item['options'])){
            $item['options'] = array_map(function($item2){
                return new ArrayElement($item2);
            }, $item['options']);
        }
        return new ArrayElement($item);
    }


    public static function makeViewForm($properties = []){
        $form = new GeneralForm();
        $properties['fields'] = array_map(function($field){
            return static::makeField($field);
        }, $properties['fields']);
        static::setProperties($form, $properties);
        return $form;
    }

    public static function makeViewGrid($properties = []){
        $grid = new GeneralGrid();
        static::setProperties($grid, $properties);

        $grid->onBehaviour("search", function(Request $request){
            return function($query){
                return $query;
            };
        });
        return $grid;
    }


    protected static function setProperties($object, $properties = []){
        foreach ($properties as $name => $value){
            $object->{$name} = $value;
        }
    }

}