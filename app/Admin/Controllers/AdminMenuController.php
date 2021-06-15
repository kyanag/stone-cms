<?php


namespace App\Admin\Controllers;


use App\Admin\ViewForms\CommonForm;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminMenu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{

    use QuickControllerTrait;


    public $name = "菜单";


    public function getModelClass()
    {
        return AdminMenu::class;
    }


    public function getForm()
    {
        $parent_options = AdminMenu::toOptions();
        return new CommonForm([
            [
                'type' => "input",
                'name' => "title",
                'label' => "菜单标题",
            ],
            [
                'type' => "input",
                'name' => "url",
                'label' => "菜单地址",
                'help' => "前缀`@url`/`@route`"
            ],
            [
                'type' => "select",
                'name' => "p_id",
                'label' => "上级菜单",
                'value' => 0,
                'options' => $parent_options
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
        ]);
    }

    public function getGrid(Request $request)
    {
        // TODO: Implement getGrid() method.
    }
}