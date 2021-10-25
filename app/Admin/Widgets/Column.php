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

    public function getCellStyle($key, $item, $index){
        if(isset($this->attributes['cellStyle'])){
            if(is_callable($this->attributes['cellStyle'])){
                return call_user_func_array($this->attributes['cellStyle'], [$key, $item, $index]);
            }else{
                return $this->attributes['cellStyle'];
            }
        }
        return null;
    }

    public function getCellClass($key, $item, $index){
        if(isset($this->attributes['cellClass'])){
            if(is_callable($this->attributes['cellClass'])){
                return call_user_func_array($this->attributes['cellClass'], [$key, $item, $index]);
            }else{
                return $this->attributes['cellClass'];
            }
        }
        return null;
    }

    public function __invoke($key, $item, $index){
        if(isset($this->attributes['cast']) && is_callable($this->attributes['cast'])){
            return call_user_func_array($this->attributes['cast'], [
                $key, $item, $index
            ]);
        }
        return @$item[$this->getName()];
    }

}