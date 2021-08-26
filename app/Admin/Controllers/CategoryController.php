<?php


namespace App\Admin\Controllers;


use App\Admin\Supports\Factory;
use App\Admin\Supports\ModelRepository;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminMenu;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    use QuickControllerTrait;


    public $name = "前台栏目";


    public function getForm()
    {
        return Factory::instance("category.form", function(){
            $parent_options = Category::options();
            return Factory::makeViewForm([
                'fields' => [
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
                                'title' => "正常",
                                'value' => 0
                            ],
                            [
                                'title' => "隐藏",
                                'value' => 1
                            ],
                        ],
                    ],
                ],
            ]);
        });

    }

    public function getGrid()
    {
        return Factory::instance("category.grid", function(){
            $grid = Factory::makeViewGrid([
                'columns' => [
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
                            $edit_url = action([static::class, "edit"], [
                                $model['id']
                            ]);
                            $delete_url = action([static::class, "destroy"], [
                                $model['id']
                            ]);
                            return implode(" ", [
                                "<a class='btn btn-info' href='{$edit_url}'>编辑</a>",
                                "<a class='btn btn-warning stone-clickajax' href='{$delete_url}' data-method='delete' data-confirm='确认是否删除'>删除</a>"
                            ]);
                        }
                    ],
                ],
            ]);
            $grid->withLinks([
                [
                    'url' => action([static::class, "create"]),
                    'title' => "新增",
                    'type' => "primary",
                ]
            ]);
            return $grid;
        });
    }

    public function getRepository()
    {
        return Factory::instance("category.repository", function(){
            return new ModelRepository(new Category());
        });
    }

}
