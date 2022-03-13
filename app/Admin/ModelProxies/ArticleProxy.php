<?php


namespace App\Admin\ModelProxies;


use App\Admin\Controllers\ArticleController;
use App\Admin\Elements\AbstractElement;
use App\Admin\Elements\Fields\OptionalField;
use App\Admin\Elements\Toolbar;
use App\Admin\Supports\Factory;
use App\Admin\Supports\URLLocator;
use App\Models\Article;

class ArticleProxy extends ModelProxy
{

    protected $modelClass = Article::class;


    public function showTitle()
    {
        return "文章";
    }


    public function showDescription()
    {
        return "文章列表";
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
                    $edit = URLLocator::article()->edit($model);
                    $delete = URLLocator::article()->destroy($model);
                    return implode(" ", [
                        "<a class='btn btn-info' href='{$edit}'>编辑</a>",
                        "<a class='btn btn-warning stone-clickajax' href='{$delete}' data-method='delete' data-confirm='确认是否删除'>删除</a>"
                    ]);
                }
            ],
        ];
        return Factory::createGridFromArray($columns)
            ->withPaginator($this->getPaginator())
            ->withWidget("toolbar", Toolbar::create([
                [
                    'title' => "新增",
                    'url' => route("admin.article.create"),
                    'type' => "primary"
                ]
            ]));
    }

    public function toForm()
    {
        $fields = [
            'title' => [
                'type' => "input",
                'name' => "title",
                'label' => "文章标题",
                'style' => "width:300px"
            ],
            [
                'type' => "input",
                'name' => "desc",
                'label' => "昵称",
                'style' => "width:500px"
            ],
            [
                'type' => "hidden",
                'name' => "doc_type",
                'label' => "文档类型",
            ],
            [
                'type' => "custom::markdown",
                'name' => "content",
                'label' => "内容",
            ],
            'status' => new OptionalField("radio", [
                'name' => "status",
                'label' => "状态",
                'value' => 0,
                'options' => [
                    [
                        'label' => "正常",
                        'value' => 0
                    ],
                    [
                        'label' => "停用",
                        'value' => 1
                    ],
                ],
            ]),
        ];
        return Factory::createFormFromArray($fields, $this->getRecord());
    }
}
