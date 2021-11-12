<?php


namespace App\Admin\Content;


use App\Admin\Content\HighTypes\HighTypeProvider;
use App\Models\FormField;
use Illuminate\Database\Schema\ColumnDefinition;
use Kyanag\Form\Core\Widget;

class HighTypeManager
{

    protected $types = [];


    public function register($name, $highTypeProvider)
    {
        if($highTypeProvider instanceof \Closure){
            $highTypeProvider = call_user_func($highTypeProvider, $this);
        }
        if($highTypeProvider instanceof HighTypeProvider){
            $this->types[$name] = $highTypeProvider;
            return $this;
        }

        return $this;
    }

    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param $name
     * @return HighTypeProvider
     * @throws \Exception
     */
    public function getProvider($name)
    {
        if(isset($this->types[$name])){
            return $this->types[$name];
        }
        throw new \Exception("[{$name}] HighTypeProvider not exists!");
    }

    /**
     * @param $name
     * @param $type
     * @param array $options
     * @return ColumnDefinition
     */
    public function createColumnDefinition($name, $type, $options = [])
    {
        return $this->getProvider($type)->forSchema($name, $type, $options);
    }

    /**
     * @param $name
     * @param $type
     * @param array $options
     * @return Widget
     */
    public function createFormField($name, $type, $options = [])
    {

    }

    public function createGridColumn($name, $type, $options = [])
    {

    }
}