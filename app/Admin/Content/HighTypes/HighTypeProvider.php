<?php


namespace App\Admin\Content\HighTypes;


use App\Models\FormField;
use Illuminate\Database\Schema\ColumnDefinition;

abstract class HighTypeProvider
{

    public function buildSchemaColumn(FormField $field)
    {
        $attributes = [
            'type' => $this->getSchemaColumnType($field),
            'name' => $field->title,
        ];
        return new ColumnDefinition($attributes);
    }

    public function buildGridColumn(FormField $field)
    {

    }

    public function buildFormField(FormField $field)
    {

    }


    protected function getFormType(FormField $field)
    {
        return "input";
    }

    protected function getSchemaColumnType(FormField $field)
    {
        return "string";
    }

    public function id()
    {
        return class_basename(static::class);
    }

    public function name()
    {
        return class_basename(static::class);
    }
}
