<?php


namespace App\Admin\Widgets;


use Kyanag\Form\Core\Widget;

class Column extends Widget
{


    public function isSortable(){
        return boolval(@$this->attributes['sortable']);
    }


    public function getTitle(){
        return @$this->attributes['title'];
    }

    public function getHeaderClass(){
        return @$this->attributes['headerClass'];
    }

    public function getHeaderStyle(){
        return @$this->attributes['headerStyle'];
    }

    public function getRowClass($key, $item, $index){
        if(isset($this->attributes['rowClass'])){
            if(is_callable($this->attributes['rowClass'])){
                return call_user_func_array($this->attributes['rowClass'], [$key, $item, $index]);
            }else{
                return $this->attributes['rowClass'];
            }
        }
        return null;
    }

    public function getRowStyle($key, $item, $index){
        if(isset($this->attributes['rowStyle'])){
            if(is_callable($this->attributes['rowStyle'])){
                return call_user_func_array($this->attributes['rowStyle'], [$key, $item, $index]);
            }else{
                return $this->attributes['rowStyle'];
            }
        }
        return null;
    }

    public function __invoke($key, $item, $index, $value){
        if(isset($this->attributes['cast']) && is_callable($this->attributes['cast'])){
            return call_user_func_array($this->attributes['cast'], [
                $key, $item, $index, $value
            ]);
        }
        return @$item[$this->getName()];
    }

}