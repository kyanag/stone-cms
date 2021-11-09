<?php


namespace App\Admin\Models;


use App\Admin\Controllers\AdminUserController;
use App\Admin\Supports\Factory;
use App\Models\Admin\AdminUser;

class AdminUserView extends AdminUser
{

    use ViewModel;

    protected $table = "admin_users";

    public function showTitle()
    {
        return "管理员";
    }


    public function fillForCreate($attributes = [])
    {

    }

    public function toForm()
    {
        return Factory::buildForm([
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
                'type' => "password",
                'name' => "repassword",
                'label' => "重复密码",
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
                        'label' => "停用",
                        'value' => 1
                    ],
                ],
            ],
        ])->withValue($this->toArray());
    }

    public function toGrid()
    {
        return Factory::buildGrid([
            [
                'name' => "id",
                'title' => "主键",
                'sortable' => true
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
                    $edit_url = action([AdminUserController::class, "edit"], [
                        $model['id']
                    ]);
                    $delete_url = action([AdminUserController::class, "destroy"], [
                        $model['id']
                    ]);
                    return implode(" ", [
                        "<a class='btn btn-info' href='{$edit_url}'>编辑</a>",
                        "<a class='btn btn-warning stone-clickajax' href='{$delete_url}' data-method='delete' data-confirm='确认是否删除'>删除</a>"
                    ]);
                }
            ],
        ]);
    }


    public function fillForLogin($attributes = []){
        foreach ($attributes as $key => $value){
            $this->setAttribute($key, $value);
        }
    }
}