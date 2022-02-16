<?php


namespace App\Admin\Elements;


use App\Admin\Interfaces\Renderable;
use App\Admin\Supports\Configure;

/**
 * Class ActiveForm
 * @package App\Admin\Elements
 *
 * @method string getId()
 * @method string getClass()
 * @method string getStyle()
 */
class ActiveForm extends AbstractElement implements Renderable
{

    protected $attributes = [
        'submitText' => "提交",
        'resetText' => "重置"
    ];

    protected $action;

    protected $method;

    protected $enctype;

    public function with($url = null, $method = null, $enctype = null)
    {
        $this->action = $url;
        $this->method = $method;
        $this->enctype = $enctype;
        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param bool $override
     * @return string
     */
    public function getMethod($override = false)
    {
        if($override){
            return $this->method;
        }
        return in_array(strtoupper($this->method), ['GET', 'POST']) ? $this->method : "POST";
    }

    public function getEnctype()
    {
        return $this->enctype;
    }

    public function submit(array $attributes)
    {
        $res = [];
        /**
         * @var string $name
         * @var Configure $child
         */
        foreach ($this->getChildren() as $name => $child){
            if(!isset($attributes[$name]) or $child->isReadonly() or $child->isReadonly()){
                continue;
            }
            $res[$name] = data_get($attributes, $name, null);
        }
        return $res;
    }

    public function render()
    {
        return view("admin::elements.form", [
            'element' => $this,
        ]);
    }
}
