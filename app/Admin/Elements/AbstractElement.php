<?php


namespace App\Admin\Elements;


use App\Admin\Interfaces\Renderable;
use Kyanag\Form\Core\Widget;

abstract class AbstractElement extends Widget
{

    protected $type;


    protected $attributes = [];


    /** @var array<Renderable>  */
    protected $children = [];


    public function __construct($type, $attributes = [], $children = [])
    {
        $this->type = $type;
        $this->children = $children;

        $this->withAttributes($attributes);
    }

    public function withAttributes(array $attributes)
    {
        foreach ($attributes as $name => $value){
            $this->attributes[$name] = $value;
        }
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function __call($name, $arguments)
    {
        if(substr($name, 0, 2) == "is"){
            $property = lcfirst(substr($name, 2));
            return isset($this->attributes[$property]) && boolval($this->attributes[$property]);
        }
        if(substr($name, 0, 3) == "get"){
            $property = lcfirst(substr($name, 3));
            return isset($this->attributes[$property]) ? $this->attributes[$property] : null;
        }
        $class = static::class;
        throw new \BadMethodCallException("Call to undefined method {$class}::{$name}");
    }
}
