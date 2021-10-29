<?php


namespace App\Admin\Models;


use App\Admin\Supports\Factory;
use App\Models\Admin\AdminUser;

class AdminUserView extends AdminUser
{

    use ViewModel;

    public function showTitle()
    {
        return "管理员";
    }

    public function toForm()
    {
        return Factory::buildForm([])->withValue($this);
    }

    public function toGrid()
    {
        return Factory::buildGrid([]);
    }


    public function fillForLogin($attributes = []){
        foreach ($attributes as $key => $value){
            $this->setAttribute($key, $value);
        }
    }
}