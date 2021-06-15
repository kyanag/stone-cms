<?php


namespace App\Admin\ViewForms;


use App\Admin\Fields\FormElement;
use Illuminate\Http\Request;
use Kyanag\Form\Interfaces\Element;

abstract class Form
{

    /**
     * @param $scene
     * @return array<Element>
     */
    abstract public function getFields();


    public function extract(Request $request){
        $keys = array_map(function($field){
            return $field->name;
        }, $this->getFields());
        return $request->only($keys);
    }

    public function toElement($url, $method = "GET", $enctype = null){
        return FormElement::fromArray([
            'type' => "form",
            'children' => $this->getFields(),
            'action' => $url,
            'method' => $method,
            'enctype' => $enctype
        ])->sync();
    }
}