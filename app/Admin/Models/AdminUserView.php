<?php


namespace App\Admin\Models;


use App\Admin\Controllers\AdminUserController;
use App\Admin\Interfaces\ViewModelInterface;
use App\Admin\Supports\Factory;
use App\Models\Admin\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminUserView extends AdminUser implements ViewModelInterface
{

    use ViewModel;

    protected $table = "admin_users";

    public function showTitle()
    {
        return "管理员";
    }


    public function inject(array $inputs)
    {
        $validatedAttributes = Validator::make($inputs, $this->getRules())->validate();
        if(isset($validatedAttributes['password_confirmation'])){
           unset($validatedAttributes['password_confirmation']);
        }
        $this->fill($validatedAttributes);
    }

    public function getRules(){
        return [
            'username' => $this->exists ? [
                Rule::unique("admin_users")->ignore($this->id),
                "admin_username"
            ] : "required|unique:admin_users|username",
            'nickname' => "required|min:4|max:20",
            'password' => "admin_password|min:6",
            'password_confirmation' => "same:password",
            'status' => "required|in:0,1"
        ];
    }

    public function toForm()
    {
        $fields = [
            [
                'type' => "input",
                'name' => "username",
                'label' => "用户名",
                'readonly' => $this->exists,
            ],
            [
                'type' => "input",
                'name' => "nickname",
                'label' => "昵称",
            ],
            [
                'type' => "password",
                'name' => "password",
                'label' => "密码",
            ],
            [
                'type' => "password",
                'name' => "password_confirmation",
                'label' => "确认密码",
            ],
            [
                'type' => "radio",
                'name' => "status",
                'label' => "状态",
                'value' => 0,
                'options' => [
                    [
                        'label' => "正常",
                        'value' => 0
                    ],
                    [
                        'label' => "停用",
                        'value' => 1
                    ],
                ],
            ],
        ];
        return $this->createFormBuilder($fields)
            //->withErrors(session()->get("errors"))
            ->getForm();
    }

    public function toGrid()
    {
        return Factory::buildGrid([
            [
                'name' => "id",
                'title' => "主键",
                'sortable' => true
            ],
            [
                'name' => "username",
                'title' => "用户名",
            ],
            [
                'name' => "nickname",
                'title' => "昵称",
            ],
            [
                'name' => "actionbar",
                'title' => "操作",
                'cast' => function($index, $model, $value){
                    $edit_url = action([AdminUserController::class, "edit"], [
                        $model['id']
                    ]);
                    $delete_url = action([AdminUserController::class, "destroy"], [
                        $model['id']
                    ]);
                    return implode(" ", [
                        "<a class='btn btn-info' href='{$edit_url}'>编辑</a>",
                        "<a class='btn btn-warning stone-clickajax' href='{$delete_url}' data-method='delete' data-confirm='确认是否删除'>删除</a>"
                    ]);
                }
            ],
        ])->withViewModel($this);
    }
}
