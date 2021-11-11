<?php


namespace App\Admin\Supports;


use App\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Kyanag\Form\Core\Widget;

class ActiveForm extends Form
{


    public function submit(array $attributes)
    {
        $res = [];
        /**
         * @var string $name
         * @var Widget $child
         */
        foreach ($this->getChildren() as $name => $child){
            if(!isset($attributes[$name]) or $child->isReadonly() or $child->isReadonly()){
                continue;
            }
            $res[$name] = data_get($attributes, $name, null);
        }
        return $res;
    }


    public function withValue($value)
    {
        return parent::withValue($value); // TODO: Change the autogenerated stub
    }
}