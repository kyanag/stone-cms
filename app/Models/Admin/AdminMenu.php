<?php

namespace App\Models\Admin;

use App\Admin\Supports\Tree;
use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    //
    protected $guarded = [];



    public function getPathAttribute(){
        if(substr($this->url, 0, 1) == "@"){
            $resource_path = $this->url;

            $type_end = strpos($resource_path, ":");
            $type = substr($resource_path, 0, $type_end);

            $param = substr($resource_path, $type_end + 1);
            switch ($type){
                case "@route:":
                    return route($param);
                case "":
            }
        }
        return $this->url;
    }



    public static function toOptions(){
        $items = AdminMenu::query()->get()->toArray();

        $items = (new Tree($items))->toTreeList(collect(), "id", "p_id", 0);
        return collect($items)->map(function($item){
            return [
                'title' => str_repeat(" - ", $item['_depth']) . $item['title'],
                'value' => $item['id'],
            ];
        })->prepend([
            'title' => "根",
            'value' => 0,
        ])->values()->toArray();
    }
}
