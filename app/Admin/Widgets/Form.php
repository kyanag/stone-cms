<?php


namespace App\Admin\Widgets;


use App\Admin\Extendeds\BehaviourTrait;
use Illuminate\Http\Request;
use Kyanag\Form\Core\Widget;

class Form extends Widget
{

    use BehaviourTrait;

    protected $action;

    protected $method;

    protected $enctype;

    public function with($url = null, $method = null, $enctype = null){
        $this->action = $url;
        $this->method = $method;
        $this->enctype = $enctype;
        return $this;
    }

    public function withValue($value){
        $this->setValue($value);
        return $this;
    }

    public function withAttribute($name, $value){
        $this->attributes[$name] = $value;
        return $this;
    }

    public function getAction(){
        return $this->action;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getEnctype(){
        return $this->enctype;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function getSubmitText(){
        return @$this->attributes['submitText'] ?: "提交";
    }

    public function getResetText(){
        return @$this->attributes['resetText'] ?: "重置";
    }
}
