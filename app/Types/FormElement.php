<?php


namespace App\Types;


use Kyanag\Form\Interfaces\Element;


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
interface FormElement extends Element
{

}