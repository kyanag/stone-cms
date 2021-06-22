<?php


namespace App\Admin\Supports;


use Illuminate\Support\Collection;

class Tree
{

    protected $items = [];


    public function __construct($items = [])
    {
        $this->items = $items;
    }


    public function toTreeList(Collection $collection, $name = "id", $p_name = "p_id", $p_id = 0, $depth = 0){
        foreach ($this->items as $index => $item){
            if($item[$p_name] == $p_id){
                if(isset($this->items[$index]['_depth'])){
                    throw new \Exception("树数据异常，存在环形");
                }
                $this->items[$index]['_depth'] = $depth;
                $item['_depth'] = $depth;

                $collection[] = $item;
                $collection = $this->toTreeList($collection, $name, $p_name, $item[$name], $depth + 1);
            }
        }
        return $collection;
    }


    public function toTree($name = "id", $p_name = "p_id", $p_id = 0, $depth = 0){
        if($depth > count($this->items)){
            //树深度不能超过
            throw new \Exception("树数据异常，存在环形");
        }
        $items = [];
        foreach ($this->items as $index => $item){
            if($item[$p_name] == $p_id){
                if(isset($this->items[$index]['_depth']) && $this->items[$index]['_depth'] >= $depth){
                    throw new \Exception("树数据异常，存在环形");
                }
                $this->items[$index]['_depth'] = $depth;
                $item['_depth'] = $depth;
                $item['_children'] = $this->toTree($name, $p_name, $item[$name], $depth + 1);
                $items[] = $item;
            }
        }
        return $items;
    }
}