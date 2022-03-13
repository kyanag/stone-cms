<?php


namespace App\Admin\Supports;


use App\Admin\Elements\ActiveForm;
use App\Admin\Elements\Element;
use App\Admin\Elements\Fields\Field;
use App\Admin\Elements\Fields\OptionalField;
use App\Admin\Elements\Grid\Column;
use App\Admin\Elements\Grid;

class Factory
{

    public static function createFormFromArray($fields, $record)
    {
        $children = [];
        foreach($fields as $key => $field)
        {
            if($field instanceof Field){
                $element = $field;
            }else{
                $type = $field['type'];
                unset($field['type']);
                switch ($type){
                    case "radio":
                    case "checkbox":
                    case "select":
                        $element = new OptionalField($type, $field);
                        break;
                    default:
                        $element = new Field($type, $field);
                        break;
                }
            }
            if(is_int($key)){
                $key = $element->getName();
            }
            if(isset($record[$key])){
                $element = $element->withValue($record[$key]);
            }
            $children[$key] = $element;
        }
        return new ActiveForm("form", [
            'submitText' => "保存"
        ], $children);
    }

    public static function createGridFromArray($columns)
    {
        $columns = collect($columns)->map(function($column){
            return new Column($column);
        })->toArray();
        return new Grid($columns);
    }
}
