<?php


namespace App\Admin\Models;


use App\Admin\Controllers\FormController;
use App\Admin\Interfaces\ResourceOperator;
use App\Admin\Supports\Factory;
use App\Models\Form;
use Illuminate\Support\Facades\Validator;

class FormView extends Form implements ResourceOperator
{
    use ViewModel;

    protected $table = "forms";

    public function showTitle()
    {
        return "表单管理";
    }

    public function inject(array $inputs)
    {
        $validatedAttributes = Validator::make($inputs, $this->getRules())->validate();
        $this->fill($validatedAttributes);
    }

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

    /**
     * @return \App\Admin\Elements\Grid
     */
    public function toGrid()
    {
        $columns = [
            [
                'name' => "id",
                'title' => "主键",
                'sortable' => 1
            ],
            [
                'name' => "name",
                'title' => "表单",
            ],
            [
                'name' => "title",
                'title' => "表单标题",
            ],
            [
                'name' => "desc",
                'title' => "简介",
            ],
            [
                'name' => "count_fields",
                'title' => "简介",
            ],
            [
                'name' => "status",
                'title' => "状态",
                'cast' => function($key, $model, $index){
                    $value = $model['status'];
                    return $value == 0 ? "<span class='badge badge-success'>启用</span>" : "<span class='badge badge-secondary'>停用</span>";
                }
            ],
            [
                'name' => "actionbar",
                'title' => "操作",
                'cast' => function($key, $model, $index){
                    $show_url = action([FormController::class, "show"], [
                        $model['id']
                    ]);
                    $edit_url = action([FormController::class, "edit"], [
                        $model['id']
                    ]);
                    $delete_url = action([FormController::class, "destroy"], [
                        $model['id']
                    ]);
                    return implode(" ", [
                        "<a class='btn btn-primary btn-sm' href='{$show_url}'>查看</a>",
                        "<a class='btn btn-info btn-sm' href='{$edit_url}'>编辑</a>",
                        "<a class='btn btn-warning btn-sm stone-clickajax' href='{$delete_url}' data-method='delete' data-confirm='确认是否删除'>删除</a>"
                    ]);
                }
            ],
        ];
        return $this->createGridBuilder($columns)
            ->withLink([
                'type' => "primary",
                'url' => route("admin.form.create"),
                'title' => "添加"
            ])
            ->getGrid();
    }

    public function getPaginator()
    {
        return static::query()->paginate();
    }
}
