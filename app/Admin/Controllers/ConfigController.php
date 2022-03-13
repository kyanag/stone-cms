<?php
namespace App\Admin\Controllers;

use App\Admin\Admin;
use App\Admin\Interfaces\ModelProxy;
use App\Admin\Supports\Factory;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Models\AdminUserView;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    protected function getForm($record)
    {
        $fields = [
            'sys_title' => [
                'type' => "input",
                'name' => "sys_title",
                'label' => "站点标题",
                'style' => "width:200px"
            ],
            'sys_keywords' => [
                'type' => "input",
                'name' => "sys_keywords",
                'label' => "站点关键字",
                'style' => "width:500px"
            ],
            'sys_desc' => [
                'type' => "input",
                'name' => "sys_desc",
                'label' => "站点介绍",
            ],
            'sys_status' => [
                'type' => "radio",
                'name' => "sys_status",
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
        return Factory::createFormFromArray($fields, $record)->withAttributes([
            'submitText' => "更新",
        ]);
    }

    public function view(Request $request)
    {
        $record = Admin::opts();
        $form = $this->getForm($record)->with(route("admin.config.update"), "put");

        return view("admin::config.view", [
            'form' => $form
        ]);
    }

    public function update(Request $request)
    {
        $form = $this->getForm([]);
        $attributes = $form->submit($request->input());

        $options = Option::query()->whereIn("key", array_keys($attributes))->get()->keyBy("key");
        foreach($attributes as $name => $value)
        {
            if(isset($options[$name])){
                $option = $options[$name];
            }else{
                $option = new Option();
            }
            $option->fill([
                'key' => $name,
                'value' => $value,
            ]);
            $option->save();
        }
        return back()->with("success", "保存成功!");
    }
}
