<?php

namespace App\Models;

use App\Admin\Supports\Tree;
use App\Models\Admin\AdminMenu;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = [];

    public function content(){
        return $this->morphOne(Content::class, "content");
    }

    public static function options(){
        $items = static::query()->get()->toArray();

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
