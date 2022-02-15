<?php


namespace App\Admin\Widgets;


use App\Admin\Supports\Configurable;
use Kyanag\Form\Core\Widget;

class Column
{
    use Configurable;

    public function isSortable(){
        return boolval(@$this->configure['sortable']);
    }

    public function getName(){
        return @$this->configure['name'];
    }

    public function getTitle(){
        return @$this->configure['title'];
    }

    public function getHeaderClass(){
        return @$this->configure['headerClass'];
    }

    public function getHeaderStyle(){
        return @$this->configure['headerStyle'];
    }

    public function getRowClass($key, $item, $index){
        if(isset($this->configure['rowClass'])){
            if(is_callable($this->configure['rowClass'])){
                return call_user_func_array($this->configure['rowClass'], [$key, $item, $index]);
            }else{
                return $this->configure['rowClass'];
            }
        }
        return null;
    }

    public function getRowStyle($key, $item, $index){
        if(isset($this->configure['rowStyle'])){
            if(is_callable($this->configure['rowStyle'])){
                return call_user_func_array($this->configure['rowStyle'], [$key, $item, $index]);
            }else{
                return $this->configure['rowStyle'];
            }
        }
        return null;
    }

    public function getCellStyle($key, $item, $index){
        if(isset($this->configure['cellStyle'])){
            if(is_callable($this->configure['cellStyle'])){
                return call_user_func_array($this->configure['cellStyle'], [$key, $item, $index]);
            }else{
                return $this->configure['cellStyle'];
            }
        }
        return null;
    }

    public function getCellClass($key, $item, $index){
        if(isset($this->configure['cellClass'])){
            if(is_callable($this->configure['cellClass'])){
                return call_user_func_array($this->configure['cellClass'], [$key, $item, $index]);
            }else{
                return $this->configure['cellClass'];
            }
        }
        return null;
    }

    public function __invoke($key, $item, $index){
        if(isset($this->configure['cast']) && is_callable($this->configure['cast'])){
            return call_user_func_array($this->configure['cast'], [
                $key, $item, $index
            ]);
        }
        return @$item[$this->getName()];
    }

}
