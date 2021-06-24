<?php


namespace App\Admin\Widgets\Forms;


use App\Admin\Widgets\ElementWidgetTrait;
use App\Admin\Widgets\Widget;
use Kyanag\Form\Interfaces\ChooseElement;
use Kyanag\Form\Interfaces\Element;

class GeneralForm implements Element, Widget
{

    use ElementWidgetTrait;
    use ActiveFormTrait;

    /**
     * @var array<Element>
     */
    public $fields = [];

    public $action;

    public $method;

    public $enctype;

    public function setValue($values)
    {
        $this->fields = array_map(function(Element $child) use($values){
            $child->value = @$values[$child->name];
            return $child;
        }, $this->fields);

        //同步值到字段里
        collect($this->fields)->each(function($element){
            /** @var Element|ChooseElement $element */
            $value = $element->value;
            if(!is_null($element->options) && is_array($element->options) ){
                collect($element->options)->each(function($option) use($value){
                    if($value == $option->value){
                        $option->selected = true;
                    }else if(is_array($value) && in_array($option->value, $value)){
                        $option->selected = true;
                    }else{
                        $option->selected = false;
                    }
                });
            }
        });
        return $this;
    }

    public function with($url = null, $method = null, $enctype = null){
        $this->action = $url;
        $this->method = $method;
        $this->enctype = $enctype;
        return $this;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function render()
    {
        return view("admin::widgets.general-form", [
            'form' => $this,
        ]);
    }
}