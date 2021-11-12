<?php


namespace App\Models\Inspectors;


use App\Admin\Interfaces\Inspector;
use App\Models\Form;

class FormInspectorAdapter implements Inspector
{

    protected $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function getTableName(): string
    {
        return $this->form->tableName();
    }

}