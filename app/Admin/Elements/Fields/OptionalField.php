<?php


namespace App\Admin\Elements\Fields;


class OptionalField extends Field
{

    public function getOptions()
    {
        $options = isset($this->attributes['options']) ? (array)$this->attributes['options'] : [];
        $value = (array)$this->getValue();

        return collect($options)->map(function($option, $index) use($value){
            $option['disabled'] = isset($option['disabled']) && boolval($option['disabled']);
            if(!is_array($option)){
                $option = [
                    'label' => $option,
                    'value' => $index
                ];
            }
            $option['selected'] = in_array($option['value'], $value);
            return $option;
        })->toArray();
    }

}
