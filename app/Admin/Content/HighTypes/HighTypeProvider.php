<?php


namespace App\Admin\Content\HighTypes;


use App\Models\FormField;
use Illuminate\Database\Schema\ColumnDefinition;

abstract class HighTypeProvider
{

    public function forSchema($name, $type, $options = [])
    {

    }

    public function forForm($name, $type, $options = [])
    {
        return [
            'type' => $this->getFormType($name, $type, $options = []),
            'name' => $name,
            'help' => @$options['desc'],
        ];
    }

    public function forGrid($name, $type, $options = [])
    {

    }


    protected function getFormType($name, $type, $options = [])
    {
        return "input";
    }
}