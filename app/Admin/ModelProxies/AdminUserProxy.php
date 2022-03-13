<?php


namespace App\Admin\ModelProxies;


use App\Admin\Elements\Toolbar;
use App\Admin\Supports\Factory;
use App\Admin\Supports\URLLocator;
use App\Models\Admin\AdminUser;

class AdminUserProxy extends ModelProxy
{
    protected $modelClass = AdminUser::class;

    public function showTitle()
    {
        return "管理员";
    }

    public function showDescription()
    {
        return "系统管理员";
    }

    public function toForm()
    {
        return Factory::createFormFromArray([], $this->record)->withAttributes([
            'submitText' => "修改",
        ]);
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
                    $edit = URLLocator::user()->edit($model);
                    $delete = URLLocator::user()->destroy($model);
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
                    'url' => URLLocator::user()->create(),
                    'type' => "primary"
                ]
            ]));
    }
}
