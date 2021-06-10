<?php


namespace App\Admin\ViewModels;


use Kyanag\Form\Core\ArrayElement;

class LoginForm extends Form
{

    public function fields()
    {
        $items = [
            [
                'type' => "input",
                'name' => "username",
                'label' => "管理员账号",
            ],
            [
                'type' => "password",
                'name' => "password",
                'label' => "管理员密码",
            ],
            [
                'type' => "switch",
                'name' => "remember_me",
                'label' => "记住我",
            ],
        ];
        return array_map(function($item){
            return new ArrayElement($item);
        }, $items);
    }

}