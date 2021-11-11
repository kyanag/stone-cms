<?php


namespace App\Admin\Models;


use App\Admin\Controllers\AdminMenuController;
use App\Admin\Controllers\FormController;
use App\Admin\Interfaces\ViewModelInterface;
use App\Admin\Supports\Factory;
use App\Admin\Supports\Tree;
use App\Models\Admin\AdminMenu;
use App\Models\Form;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class FormView extends Form implements ViewModelInterface
{
    use ViewModel;

    protected $table = "forms";

    public function showTitle()
    {
        return "表单管理";
    }

//    public function inject(array $inputs)
//    {
//        $validatedAttributes = Validator::make($inputs, $this->getRules())->validate();
//        $this->fill($validatedAttributes);
//    }

    public function getRules(){
        return [
            'name' => $this->exists ? "" : "required|alpha_num",
            'title' => "required|min:2|max:10",
            'desc' => "",
            'status' => "required|in:0,1"
        ];
    }

    public function toForm()
    {
        $fields = [
            [
                'type' => "input",
                'name' => "name",
                'label' => "表单名称",
                'readonly' => $this->exists,
            ],
            [
                'type' => "input",
                'name' => "title",
                'label' => "表单标题",
            ],
            [
                'type' => "textarea",
                'name' => "desc",
                'label' => "表单简介",
            ],
            [
                'type' => "input",
                'name' => "count_fields",
                'label' => "字段总数",
                'readonly' => true,
                'value' => 0,
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
        return $this->createFormBuilder($fields)->getForm();
    }

    public function toGrid()
    {
        $columns = [
            [
                'name' => "id",
                'title' => "主键",
                'sortable' => 1
            ],
            [
                'name' => "title",
                'title' => "菜单标题",
            ],
            [
                'name' => "url",
                'title' => "菜单地址",
            ],
            [
                'name' => "p_id",
                'title' => "上级菜单",
                'cast' => function($key, $model, $index){
                    if($model['p_id'] == 0){
                        return "<span class='color-red'> 根 </span>";
                    }
                    if($model['parent_menu']){
                        return $model['parent_menu']['title'];
                    }
                    return "<span class='color-red'> - </span>";
                }
            ],
            [
                'name' => "index",
                'title' => "排序",
            ],
            [
                'name' => "status",
                'title' => "状态",
                'cast' => function($key, $model, $index){
                    $value = $model['status'];
                    return $value == 0 ? "<span class='badge badge-success'>生效</span>" : "<span class='badge badge-secondary'>隐藏</span>";
                }
            ],
            [
                'name' => "actionbar",
                'title' => "操作",
                'cast' => function($key, $model, $index){
                    $edit_url = action([FormController::class, "edit"], [
                        $model['id']
                    ]);
                    $delete_url = action([FormController::class, "destroy"], [
                        $model['id']
                    ]);
                    return implode(" ", [
                        "<a class='btn btn-info' href='{$edit_url}'>编辑</a>",
                        "<a class='btn btn-warning stone-clickajax' href='{$delete_url}' data-method='delete' data-confirm='确认是否删除'>删除</a>"
                    ]);
                }
            ],
        ];
        return Factory::buildGrid($columns)->withViewModel($this);
    }

    public function getPaginator()
    {
        return static::query()->with([
            'parent_menu' => function($query){
                return $query->select("id", "title");
            }
        ])->paginate($this->pageSize);
    }

    public static function options(){
        $items = AdminMenu::query()->get()->toArray();

        $items = (new Tree($items))->toTreeList(collect(), "id", "p_id", 0);
        return collect($items)->map(function($item){
            return [
                'label' => str_repeat(" - ", $item['_depth']) . $item['title'],
                'value' => $item['id'],
            ];
        })->prepend([
            'label' => "根",
            'value' => 0,
        ])->values()->toArray();
    }

    public static function tree(){
        if(env("APP_DEBUG", false)){
            $items = AdminMenu::query()->get()->toArray();
            $tree = (new Tree($items))->toTree("id", "p_id", 0);
            return $tree;
        }
        return Cache::tags("admin-menu.index")->remember("admin-menu.tree", 2 * 60, function(){
            $items = AdminMenu::query()->get()->toArray();
            $tree = (new Tree($items))->toTree("id", "p_id", 0);
            return $tree;
        });
    }

}
