<?php


namespace App\Admin\Controllers;


use App\Admin\Supports\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected function getForm(){
        return Factory::makeViewForm([
            'fields' => [
                [
                    'type' => "input",
                    'name' => "username",
                    'label' => "账户",
                ],
                [
                    'type' => "password",
                    'name' => "password",
                    'label' => "密码"
                ],
                [
                    'type' => "switch",
                    'name' => "remember_me",
                    'label' => "记住我",
                    'value' => 1
                ]
            ],
        ]);
    }

    public function entry(){

        return view("admin::login", [
            'loginForm' => $this->getForm(),
        ]);
    }

    public function login(Request $request){
        $loginForm = $this->getForm();
        $attributes = $loginForm->extract($request);

        $remember_me = @$attributes['remember_me'] == 1;
        unset($attributes['remember_me']);

        if(Auth::guard("admin")->attempt($attributes, $remember_me)){
            session()->flash("success", "登录成功!");
            return redirect(route("admin.home"));
        }else{
            return 1;
        }
    }
}