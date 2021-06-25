<?php


namespace App\Admin\Widgets\Forms;


use App\Admin\Extendeds\BehaviourTrait;
use App\Admin\Widgets\ElementWidgetTrait;
use App\Admin\Widgets\Widget;
use Illuminate\Http\Request;
use Kyanag\Form\Interfaces\ChooseElement;
use Kyanag\Form\Interfaces\Element;

class GeneralForm implements Element, Widget
{

    use BehaviourTrait;
    use ElementWidgetTrait;

    /**
     * @var array<Element>
     */
    public $fields = [];

    public $action;

    public $method;

    public $enctype;


    public function __construct()
    {
        $this->onBehaviour("submit", function(Request $request){
            $keys = array_map(function($element){
                return $element->name;
            }, $this->getFields());
            return $request->only($keys);
        });
    }

    public function setValue($values)
    {
        $this->fields = array_map(function(Element $child) use($values){
            $child->value = @$values[$child->name];
            return $child;
        }, $this->fields);

        return $this;
    }

    /**
     * 刷新表单 让selected checked 生效
     */
    protected function refresh(){
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
        $this->refresh();
        return view("admin::widgets.general-form", [
            'form' => $this,
        ]);
    }
}