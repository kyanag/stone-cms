<?php


namespace App\Admin\Controllers;


use App\Admin\Models\AdminUserView;
use App\Admin\Supports\Factory;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected function getForm(Request $request){
        return Factory::buildForm([
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
        ], $this->getViewModel($request), [
            'submitText' => "登录"
        ])->withValue($request->old());
    }

    protected function getViewModel(Request $request){
        return new AdminUserView();
    }

    public function entry(Request $request){
        return view("admin::login", [
            'loginForm' => $this->getForm($request),
        ]);
    }

    public function login(Request $request){
        $attributes = $request->only([
            'username', "password"
        ]);
        $remember_me = $request->input("remember_me", 0) == 1;

        if(Auth::guard("admin")->attempt($attributes, $remember_me)){
            session()->flash("success", "登录成功!");
            return redirect(route("admin.home"));
        }else{
            return back()->withInput();
        }
    }

    public function logout(){
        return back();
        Auth::guard("admin")->logout();

    }
}
