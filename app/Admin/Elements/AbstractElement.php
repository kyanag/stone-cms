<?php


namespace App\Admin\Elements;


use App\Admin\Interfaces\Renderable;
use App\Admin\Supports\Configure;

abstract class AbstractElement extends Configure
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

    public function type(){
        return $this->type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function withAttributes(array $attributes)
    {
        foreach ($attributes as $name => $value){
            $this->attributes[$name] = $value;
        }
        return $this;
    }
}
