<?php

namespace App\Models\Admin;

use App\Admin\Supports\Tree;
use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    //
    protected $guarded = [];




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
