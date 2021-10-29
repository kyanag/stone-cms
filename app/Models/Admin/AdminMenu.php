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
        static::addGlobalScope("sorted", function($query){
            return $query->orderBy("index", "desc");
        });
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

    public function parent_menu(){
        return $this->belongsTo(AdminMenu::class, "p_id", "id");
    }
}
