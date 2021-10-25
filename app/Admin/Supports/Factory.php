<?php


namespace App\Admin\Supports;


use App\Admin\Widgets\Column;
use App\Admin\Widgets\Form;
use App\Admin\Widgets\Grid;
use Illuminate\Database\Eloquent\Model;
use Kyanag\Form\Core\Widget;
use function Kyanag\Form\createWidget;

class Factory
{

    static protected $instances = [];

    /**
     * @param $fields
     * @param $viewModel
     * @return Form
     */
    public static function buildForm($fields, Model $model){
        $elements = array_map(function($props) use($model){
            $props['value'] = $model->getAttribute($props['name']) ?: @$props['value'];
            return createWidget($props);
        }, $fields);
        return new Form("custom::form", [], $elements);
    }

    /**
     * @param $columns
     * @param $viewModel
     * @return Grid
     */
    public static function buildGrid($columns){
        $columns = array_map(function($item){
            return new Column("column", $item);
        }, $columns);
        return new Grid("custom::grid", [], $columns);
    }
}
