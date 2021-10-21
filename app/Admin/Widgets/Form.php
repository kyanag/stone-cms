<?php


namespace App\Admin\Widgets;


use Kyanag\Form\Core\Widget;

class Form extends Widget
{

    protected $action;

    protected $method;

    protected $enctype;

    public function with($url = null, $method = null, $enctype = null){
        $this->action = $url;
        $this->method = $method;
        $this->enctype = $enctype;
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
}