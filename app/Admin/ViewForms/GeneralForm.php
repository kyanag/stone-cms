<?php


namespace App\Admin\ViewForms;


use Kyanag\Form\Core\ArrayElement;

class GeneralForm extends Form
{

    private $fields = [];

    private function __construct()
    {
    }

    public function getFields()
    {
        return $this->fields;
    }


    public static function fromArray(array $fields){
        $fields = array_map(function($item){
            return new ArrayElement($item);
        }, $fields);
        $form = new static();
        $form->fields = $fields;
        return $form;
    }
}