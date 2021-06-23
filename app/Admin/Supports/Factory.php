<?php


namespace App\Admin\Supports;


use App\Admin\Widgets\Forms\GeneralForm;
use App\Admin\Widgets\Grids\GeneralGrid;
use Kyanag\Form\Core\ArrayElement;
use Kyanag\Form\Interfaces\Element;

class Factory
{

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
        return $grid;
    }


    protected static function setProperties($object, $properties = []){
        foreach ($properties as $name => $value){
            $object->{$name} = $value;
        }
    }

}