<?php

namespace App\Models\Admin;

use App\Admin\Supports\Tree;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AdminMenu extends Model
{
    //
    protected $guarded = [];


    protected $appends = [
        'path'
    ];


    protected static function boot()
    {
        parent::boot();
        static::saving(function($model){
            //TODO 修改后的上级菜单 不能 是修改之前的下级菜单
        });

        static::saved(function($model){
            //更新树缓存
        });
    }


    public function scopeForCategory($query, Category $category){
        return $query;
            //->where("category_id", $category['id']);
    }

    public function getPathAttribute(){
        if(substr($this->url, 0, 1) == "@"){
            $resource_path = $this->url;

            $type_end = strpos($resource_path, ":");
            $type = substr($resource_path, 0, $type_end);

            $param = substr($resource_path, $type_end + 1);
            switch ($type){
                case "@route:":
                    return route($param);
            }
        }
        return $this->url;
    }


    public static function options(){
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

    public static function tree(){
        if(env("APP_DEBUG", false)){
            $items = AdminMenu::query()->get()->toArray();
            $tree = (new Tree($items))->toTree("id", "p_id", 0);
            return $tree;
        }
        return Cache::tags("admin-menu.index")->remember("admin-menu.tree", 2 * 60, function(){
            $items = AdminMenu::query()->get()->toArray();
            $tree = (new Tree($items))->toTree("id", "p_id", 0);
            return $tree;
        });
    }
}
