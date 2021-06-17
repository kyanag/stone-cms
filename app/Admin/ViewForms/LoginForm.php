<?php


namespace App\Admin\ViewForms;


use Kyanag\Form\Core\ArrayElement;

class LoginForm extends Form
{

    public function getFields()
    {
        return array2FormFields([
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
        ]);
    }

}