<?php


namespace App\Admin\Models;


use App\Admin\Supports\Factory;
use App\Models\Admin\AdminUser;

class AdminUserView extends AdminUser
{

    use ViewModel;


    public function toForm()
    {
        return Factory::buildForm([], $this);
    }

    public function toGrid()
    {
        return Factory::buildGrid([]);
    }

    public function toView()
    {
        return $this->toForm();
    }


    public function fillForLogin($attributes = []){
        foreach ($attributes as $key => $value){
            $this->setAttribute($key, $value);
        }
    }
}