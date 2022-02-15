<?php


namespace App\Admin;


use App\Admin\Elements\ActiveForm;

class Admin
{

    public static function menus()
    {
        return [
            [
                'title' => "首页",
                'url' => route("admin.home"),
            ],
            [
                'title' => "管理员",
                'url' => route("admin.user.index")
            ]
        ];
    }
}
