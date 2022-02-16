<?php


namespace App\Admin\Supports;


abstract class Configure
{

    protected $attributes = [];

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
