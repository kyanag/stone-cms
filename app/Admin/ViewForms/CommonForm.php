<?php


namespace App\Admin\ViewForms;


class CommonForm extends Form
{

    private $fields = [];

    public function __construct($fields = [])
    {
        $this->fields = $fields;
    }

    public function getFields()
    {
        return $this->fields;
    }

}