<?php


namespace App\Admin\ViewModels;


use App\Admin\Fields\FormElement;
use Illuminate\Http\Request;
use Kyanag\Form\Interfaces\Element;

abstract class Form
{
    const SCENE_CREATE = 0b01;

    const SCENE_EDIT = 0b10;

    /**
     * @param $scene
     * @return array<Element>
     */
    abstract public function fields();


    public function resolveValuesFormRequest(Request $request){
        $keys = array_map(function($field){
            return $field->name;
        }, $this->fields());
        return $request->only($keys);
    }

    public function toForm($url, $method = "GET", $enctype = null){
        $form = new FormElement([
            'type' => "form",
            'children' => $this->fields(),
        ]);
        $form->action = $url;
        $form->method = $method;
        $form->enctype = $enctype;
        return $form;
    }
}