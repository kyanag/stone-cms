<?php


namespace App\Admin\Fields;


use Kyanag\Form\Core\ArrayElement;
use Kyanag\Form\Interfaces\Element;
use Kyanag\Form\Interfaces\Option;


/**
 * Interface FormElement
 * @package App\Admin\form
 *
 * @property string $action
 * @property string $method
 * @property string $enctype
 * @property array<Element> $children
 *
 * @property string $title
 * @property string $description
 */
class FormElement extends ArrayElement
{

    public static function fromArray($items){
        $items['children'] = array_map(function($item){
            if($item instanceof Element){
                return $item;
            }
            if(isset($item['options']) && is_array($item['options'])){
                $item['options'] = array_map(function($item2){
                    return new ArrayElement($item2);
                }, $item['options']);
            }
            return new ArrayElement($item);
        }, $items['children']);
        return new static($items);
    }


    public function setValue($values){
        $this->children = array_map(function(Element $child) use($values){
            $child->value = @$values[$child->name];
        }, $this->children);
        return $this;
    }


    /**
     *
     */
    public function sync(){
        collect($this->children)->each(function($element){
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
}