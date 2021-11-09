<?php


namespace App\Admin\Models;


use App\Admin\Controllers\CategoryController;
use App\Admin\Supports\Factory;
use App\Admin\Supports\Tree;
use App\Models\Category;

class CategoryView extends Category
{

    use ViewModel;

    protected $table = "categories";

    public function showTitle()
    {
        return "前台栏目";
    }

    public function toForm()
    {
        $parent_options = static::options();
        $fields = [
            [
                'type' => "input",
                'name' => "title",
                'label' => "栏目标题",
            ],
            [
                'type' => "select",
                'name' => "p_id",
                'label' => "上级栏目",
                'value' => 0,
                'options' => $parent_options
            ],
            [
                'type' => "input",
                'name' => "keywords",
                'label' => "关键字",
            ],
            [
                'type' => "input",
                'name' => "description",
                'label' => "简介",
            ],
            [
                'type' => "input",
                'name' => "bg_img",
                'label' => "背景图",
                'value' => "",
            ],
            [
                'type' => "input",
                'name' => "jump_to",
                'label' => "跳转到",
            ],
            [
                'type' => "radio",
                'name' => "status",
                'label' => "状态",
                'value' => 0,
                'options' => [
                    [
                        'label' => "正常",
                        'value' => 0
                    ],
                    [
                        'label' => "隐藏",
                        'value' => 1
                    ],
                ],
            ],
        ];
        return Factory::buildForm($fields)->withValue($this);
    }


    public function toGrid()
    {
        $columns = [
            [
                'name' => "id",
                'title' => "主键",
                'sortable' => 1
            ],
            [
                'name' => "title",
                'title' => "菜单标题",
            ],
            [
                'name' => "url",
                'title' => "菜单地址",
            ],
            [
                'name' => "p_id",
                'title' => "上级菜单",
            ],
            [
                'name' => "index",
                'title' => "排序",
            ],
            [
                'name' => "status",
                'title' => "状态",
                'cast' => function($index, $model, $value){
                    return $value == 0 ? "生效" : "隐藏";
                }
            ],
            [
                'name' => "actionbar",
                'title' => "操作",
                'cast' => function($index, $model, $value){
                    $edit_url = action([CategoryController::class, "edit"], [
                        $model['id']
                    ]);
                    $delete_url = action([CategoryController::class, "destroy"], [
                        $model['id']
                    ]);
                    return implode(" ", [
                        "<a class='btn btn-info' href='{$edit_url}'>编辑</a>",
                        "<a class='btn btn-warning stone-clickajax' href='{$delete_url}' data-method='delete' data-confirm='确认是否删除'>删除</a>"
                    ]);
                }
            ],
        ];
        return Factory::buildGrid($columns)->withViewModel($this);
    }

    public static function options(){
        $items = static::query()->get()->toArray();

        $items = (new Tree($items))->toTreeList(collect(), "id", "p_id", 0);
        return collect($items)->map(function($item){
            return [
                'label' => str_repeat(" - ", $item['_depth']) . $item['title'],
                'value' => $item['id'],
            ];
        })->prepend([
            'label' => "根",
            'value' => 0,
        ])->values()->toArray();
    }
}
