<?php


namespace App\Admin\Controllers;


use App\Admin\Supports\Factory;
use App\Admin\Supports\ModelRepository;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminMenu;
use App\Models\article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    use QuickControllerTrait;


    public $name = "内容";


    public function getForm(Model $model = null)
    {
        $form = Factory::makeViewForm([
            'fields' => [
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
            ],
        ]);
        if($model){
            $form->setValue($model->toArray());
        }
        return $form;
    }

    public function getGrid()
    {
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
    }

    public function getRepository()
    {
        return Factory::instance("article.repository", function(){
            return new ModelRepository(new article());
        });
    }

}
