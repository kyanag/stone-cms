<?php


namespace App\Admin\Supports;


use App\Admin\Widgets\Column;
use App\Admin\Widgets\Form;
use App\Admin\Widgets\Grid;
use function Kyanag\Form\createWidget;

class Factory
{

    /**
     * @param $fields
     * @param $viewModel
     * @return Form
     */
    public static function buildForm($fields, $props = []){
        $elements = array_map(function($props){
            return createWidget($props);
        }, $fields);
        return new ActiveForm("custom::form", $props, $elements);
    }

    /**
     * @param $columns
     * @param $viewModel
     * @return Grid
     */
    public static function buildGrid($columns, $props = []){
        $columns = array_map(function($item){
            return new Column("column", $item);
        }, $columns);
        return new Grid("custom::grid", $props, $columns);
    }
}
