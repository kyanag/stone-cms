<?php


namespace App\Admin\Widgets\Forms;

use Illuminate\Http\Request;
use Kyanag\Form\Interfaces\Element;

/**
 * Trait ActiveFormTrait
 * @package App\Admin\Widgets\Forms
 * @mixin GeneralForm
 */
trait ActiveFormTrait
{

    public function extract(Request $request){
        $keys = array_map(function($element){
            return $element->name;
        }, $this->getFields());
        return $request->only($keys);
    }

    /**
     * @return array<Element>
     */
    abstract public function getFields();
}