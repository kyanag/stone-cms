<?php


namespace App\Admin\Content;


use App\Admin\Content\HighTypes\HighTypeProvider;

class HighTypeManager
{

    protected $types = [];


    public function register($highTypeProvider)
    {
        if(class_exists($highTypeProvider)){
            $highTypeProvider = app()->make($highTypeProvider);
        }
        if($highTypeProvider instanceof \Closure){
            $highTypeProvider = call_user_func($highTypeProvider, $this);
        }
        if($highTypeProvider instanceof HighTypeProvider){
            $name = $highTypeProvider->id();
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

    public function toOptions()
    {
        return collect($this->getTypes())->map(function(HighTypeProvider $provider, $id){
            return [
                'label' => $provider->name(),
                'value' => $provider->id(),
            ];
        })->values()->toArray();
    }
}
