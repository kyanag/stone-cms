<?php


namespace App\Admin\Controllers;


use App\Admin\Supports\Factory;
use App\Admin\Supports\ModelRepository;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminUser;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    use QuickControllerTrait;

    protected $name = "管理员";

    public function getRepository()
    {
        return Factory::instance("category.repository", function(){
            return new ModelRepository(new AdminUser());
        });
    }

    public function getForm()
    {
        return Factory::instance("admin-user.form", function(){
            return Factory::makeViewForm([
                'fields' => [
                    [
                        'type' => "input",
                        'name' => "username",
                        'label' => "用户名",
                    ],
                    [
                        'type' => "input",
                        'name' => "nickname",
                        'label' => "昵称",
                    ],
                    [
                        'type' => "password",
                        'name' => "password",
                        'label' => "密码",
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
                                'title' => "停用",
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
        return Factory::instance("admin-user.grid", function(){
            $grid = Factory::makeViewGrid([
                'columns' => [
                    [
                        'name' => "id",
                        'title' => "主键",
                        'sortable' => 1
                    ],
                    [
                        'name' => "username",
                        'title' => "用户名",
                    ],
                    [
                        'name' => "nickname",
                        'title' => "昵称",
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
}
