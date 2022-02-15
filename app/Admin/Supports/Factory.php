<?php


namespace App\Admin\Supports;


use App\Admin\Elements\ActiveForm;
use App\Admin\Elements\Element;
use App\Admin\Widgets\Column;
use App\Admin\Elements\Grid;
use function Kyanag\Form\createWidget;

class Factory
{

    public static function createFormFromArray($fields, $record)
    {
        $children = [];
        foreach($fields as $name => $field)
        {
            if(isset($record[$name])){
                $field['value'] = $record[$name];
            }
            $type = $field['type'];
            unset($field['type']);

            $children[] = new Element($type, $field);
        }
        return new ActiveForm("form", [
            'submitText' => "登录"
        ], $children);
    }

    public static function createGridFromArray($columns)
    {

    }
}
