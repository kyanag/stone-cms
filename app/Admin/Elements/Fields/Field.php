<?php


namespace App\Admin\Elements\Fields;


use App\Admin\Elements\Element;

/**
 * Class Field
 * @package App\Admin\Elements\Fields
 *
 * @method string getName()
 * @method string getLabel()
 * @method bool isReadonly()
 * @method bool isDisabled()
 */
class Field extends Element
{

    public function withValue($value)
    {
        $this->attributes['value'] = $value;
        return $this;
    }

}
