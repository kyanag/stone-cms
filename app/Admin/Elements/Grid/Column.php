<?php


namespace App\Admin\Elements\Grid;

use App\Admin\Supports\Configure;

/**
 * Class Column
 * @package App\Admin\Widgets
 *
 * @method bool isSortable()
 * @method string getName()
 * @method string getTitle()
 */
class Column extends Configure
{

    protected $attributes = [];

    public function __construct($attributes = [])
    {
        foreach ($attributes as $name => $value){
            $this->attributes[$name] = $value;
        }
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
