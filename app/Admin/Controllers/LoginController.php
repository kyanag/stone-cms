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
        ], $this->getViewModel($request));
    }

    protected function getViewModel(Request $request){
        $model = new AdminUserView();
        $model->fillForLogin($request->input());
        return $model;
    }

    public function entry(Request $request){
        return view("admin::login", [
            'loginForm' => $this->getForm($request),
        ]);
    }

    public function login(Request $request){
        $viewModel = $this->getViewModel($request);

        $attributes = $viewModel->only([
            'username', "password"
        ]);
        $remember_me = $viewModel->getAttribute("remember_me") == 1;

        if(Auth::guard("admin")->attempt($attributes, $remember_me)){
            session()->flash("success", "登录成功!");
            return redirect(route("admin.home"));
        }else{
            $attributes['remember_me'] = $remember_me;
            return redirect(route("admin.entry"))->withInput($attributes);
        }
    }

    public function logout(){
        //Auth::guard("admin")->logout();
        throw new \Exception("退出失败!");
        return redirect(route("admin.login"));
    }
}
