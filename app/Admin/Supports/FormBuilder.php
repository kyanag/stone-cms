<?php


namespace App\Admin\Supports;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Kyanag\Form\Core\Widget;
use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;

class FormBuilder
{

    protected $model;

    protected $fields = [];

    protected $children = [];

    protected $unresolvedChildren = [];

    protected $overrideValues = [];

    /**
     * @var MessageBag|array
     */
    protected $errors = [];

    public function __construct($model)
    {
        $this->model = $model;
    }


    public function withOverrideValues(array $values){
        $this->overrideValues = $values;
        return $this;
    }

    public function withErrors($errors){
        if($errors instanceof ViewErrorBag){
            $errors = $errors->getBags();
        }
        $this->errors = $errors;
        return $this;
    }

    protected function getError($key, $default = null){
        if($this->errors instanceof MessageBag){
            return $this->errors->get($key);
        }
        return data_get($this->errors, $key, $default);
    }

    protected function getValue($key, $default = null){
        if(isset($this->overrideValues[$key])){
            return $this->overrideValues[$key];
        }
        return data_get($this->model, $key, $default);
    }

    public function add($child, $type = null, $attributes = [])
    {
        if(is_array($child)){
            $type = $child['type'];
            $attributes = collect($child)->except(['name', "type"])->toArray();
            $child = $child['name'];
        }
        if($child instanceof Widget){
            $this->children[$child->getName()] = $child;
            return $this;
        }
        if(!is_string($child)){
            throw new UnexpectedTypeException($child, "string or Kyanag\\Form\\Core\\Widget");
        }
        $this->children[$child] = null;
        $this->unresolvedChildren[$child] = [
            'type' => $type,
            'attributes' => $attributes
        ];
        return $this;
    }

    protected function create($child, $type = null, $attributes = [])
    {
        $attributes['name'] = $child;
        return new Widget($type, $attributes, []);
    }

    public function resolveChildren()
    {
        foreach ($this->unresolvedChildren as $name => $info)
        {
            $attributes = $info['attributes'];
            //数据注入
            if($value = $this->getValue($name, null)){
                $attributes['value'] = $value;
            }
            //错误提示注入
            if($error = $this->getError($name, null)){
                $attributes['error'] = $error;
            }
            if($name == 'password'){
//                var_dump($this->errors, $name, $attributes);
//                exit();
            }
            $this->children[$name] = $this->create($name, $info['type'], $attributes);
        }
        $this->unresolvedChildren = [];
    }

    public function getForm()
    {
        $this->resolveChildren();
        return new ActiveForm("custom::form", [], $this->children);
    }
}