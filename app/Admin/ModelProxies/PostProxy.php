<?php


namespace App\Admin\ModelProxies;


use App\Admin\Admin;
use App\Admin\Controllers\ArticleController;
use App\Admin\Elements\Fields\OptionalField;
use App\Admin\Elements\Toolbar;
use App\Admin\Supports\Factory;
use App\Admin\Supports\ResourceMeta;
use App\Admin\Supports\URLLocator;
use App\Models\Post;

class PostProxy extends ModelProxy
{

    protected $modelClass = Post::class;


    public function showTitle()
    {
        return "内容";
    }


    public function showDescription()
    {
        return "内容";
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
                'name' => "post_title",
                'title' => "内容标题",
            ],
            [
                'name' => "post_type",
                'title' => "状态",
                'cast' => function($index, $model, $value){
                    return $value == 0 ? "生效" : "隐藏";
                }
            ],
            [
                'name' => "actionbar",
                'title' => "操作",
                'cast' => function($index, $model, $value){
                    $edit = URLLocator::getLocator($model['post_type'])->edit($model);
                    $delete = URLLocator::getLocator($model['post_type'])->destroy($model);;
                    return implode(" ", [
                        "<a class='btn btn-info' href='{$edit}'>编辑</a>",
                        "<a class='btn btn-warning stone-clickajax' href='{$delete}' data-method='delete' data-confirm='确认是否删除'>删除</a>"
                    ]);
                }
            ],
        ];

        //TODO
        $subLinks = collect(Admin::resources()->getResourceMetas())->map(function(ResourceMeta $meta){
            return [
                'title' => $meta->getName(),
                'url' => URLLocator::getLocator($meta->getId())->create(),
                'type' => "primary",
            ];
        });
        return Factory::createGridFromArray($columns)
            ->withPaginator($this->getPaginator())
            ->withWidget("toolbar", Toolbar::create([
                [
                    'title' => "新增",
                    'url' => "javascript:void(0)",
                    'type' => "primary",
                    'children' => $subLinks,
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
