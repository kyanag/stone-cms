<?php


namespace App\Admin\Controllers;


use App\Admin\ViewModels\LoginForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function entry(){
        $loginForm = new LoginForm();
        return app("renderer")->render(
            $loginForm->toForm(route("admin.login.do"), "POST")
        );
    }

    public function login(Request $request){
        $loginForm = new LoginForm();
        $attributes = $loginForm->resolveValuesFormRequest($request);

        $remember_me = $attributes['remember_me'] == 1;
        unset($attributes['remember_me']);

        if(Auth::guard("admin")->attempt($attributes, $remember_me)){
            session()->flash("success", "登录成功!");
            return Auth::guard("admin")->user();
        }else{
            return 1;
        }
    }
}