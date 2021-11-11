<?php


namespace App\Admin\Models;


use App\Admin\Controllers\ArticleController;
use App\Admin\Supports\Factory;
use App\Models\Article;

class ArticleView extends Article
{

    use ViewModel;

    protected $table = "articles";

    public function showTitle()
    {
        return "文章";
    }

    public function toForm()
    {
        $fields = [
            [
                'type' => "input",
                'name' => "title",
                'label' => "栏目标题",
            ],
            [
                'type' => "input",
                'name' => "excerpt",
                'label' => "摘要",
            ],
            [
                'type' => "input",
                'name' => "author_id",
                'label' => "作者",
            ],
            [
                'type' => "custom::markdown",
                'name' => "content",
                'label' => "内容",
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
        ];
        return $this->createFormBuilder($fields)->getForm();
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
                    $edit_url = action([ArticleController::class, "edit"], [
                        $model['id']
                    ]);
                    $delete_url = action([ArticleController::class, "destroy"], [
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
}
