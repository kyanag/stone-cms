<?php


namespace App\Admin\Models;


use App\Admin\Content\HighTypeManager;
use App\Admin\Controllers\FormController;
use App\Admin\Interfaces\ResourceOperator;
use App\Admin\Supports\Factory;
use App\Models\FormField;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Support\Facades\Validator;

class FormFieldView extends FormField implements ResourceOperator
{
    use ViewModel;

    protected $table = "form_fields";

    public function showTitle()
    {
        return "【{$this->form->title}】 字段管理";
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
            'type' => "",
            'is_required' => "required|in:0,1"
        ];
    }

    public function toForm()
    {
        $fields = [
            [
                'type' => "input",
                'name' => "name",
                'label' => "字段名称",
                'readonly' => $this->exists,
            ],
            [
                'type' => "input",
                'name' => "title",
                'label' => "字段标题",
            ],
            [
                'type' => "textarea",
                'name' => "desc",
                'label' => "字段简介",
            ],
            [
                'type' => "select",
                'name' => "type",
                'label' => "字段类型",
                'options' => $this->toFormOptions(),
            ],
            [
                'id' => "switch-is_required",
                'type' => "switch",
                'name' => "is_required",
                'label' => "必填",
                'value' => 0,
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


    public function toAdminResourceLocation()
    {
        if(!$this->exists){
            return action([$this->getController(), "store"], [$this->form_id]);
        }
        return action([$this->getController(), "update"], [$this->form_id, $this]);
    }

    public function fireModelEvent($event, $halt = true)
    {
        return parent::fireModelEvent($event, $halt);
    }

    /**
     * @return ColumnDefinition
     */
    public function toSchemaColumn()
    {
        $attributes = [
            'type' => "string",
            'name' => $this->name,
            'default' => "",
        ];
        switch($this->type){
            case "image":
            case "file":
            case "string":
                $attributes['type'] = "string";
                $attributes['length'] = 255;
                break;
            case "number":
                $attributes['type'] = "decimal";
                $attributes['default'] = 0;
                $attributes['total'] = 8;
                $attributes['places'] = 2;
                break;
            case "datetime":
                $attributes['type'] = "timestamp";
                $attributes['precision'] = 0;
                break;
            case "images":
            case "files":
            case "text":
                $attributes['type'] = "text";
                break;
        }
        return new ColumnDefinition($attributes);
    }

    public function toGridColumn()
    {
        return [
            'name' => "id",
            'title' => "主键",
        ];
    }

    public function toFormField()
    {
        return [
            'name' => "id",
            'title' => "主键",
        ];
    }

    public function toFormOptions(){
        return collect(static::typeProviders())->map(function ($value, $key){
            return [
                'label' => $value['label'],
                'value' => $key,
            ];
        })->values();
    }

    /**
     * 提供的字段类型
     * @return array
     */
    public static function typeProviders(){
        return [
            //文本
            'string' => [
                'label' => "文本",
                'schema' => [
                    'type' => "string",
                    'length' => 50,
                ],
                'form' => [
                    'type' => "input",
                ],
                'grid' => [],
            ],
            //长文本
            'text' => [
                'label' => "大段文本",
                'schema' => [
                    'type' => "string",
                    'length' => 50,
                ],
                'form' => [
                    'type' => "textarea",
                ],
                'grid' => [],
            ],
            //数字类型
            'number' => [
                'label' => "数字",
                'schema' => [
                    'type' => "string",
                    'length' => 50,
                ],
                'form' => [
                    'type' => "textarea",
                    'style' => "width:100px",
                ],
                'grid' => [],
            ],
            //时间
            'datetime' => [
                'label' => "时间",
                'schema' => [
                    'type' => "string",
                    'length' => 50,
                ],
                'form' => [
                    'type' => "input",
                ],
                'grid' => [],
            ],
            //图片类型
            'image' => [
                'label' => "图片",
                'schema' => [
                    'type' => "string",
                    'length' => 50,
                ],
                'form' => [
                    'type' => "input",
                ],
                'grid' => [],
            ],
            //多图
            'images' => [
                'label' => "多图",
                'schema' => [
                    'type' => "string",
                    'length' => 50,
                ],
                'form' => [
                    'type' => "input",
                ],
                'grid' => [],
            ],
            //单文件
            'file' => [
                'label' => "多图",
                'schema' => [
                    'type' => "string",
                    'length' => 50,
                ],
                'form' => [
                    'type' => "input",
                ],
                'grid' => [],
            ],
            //多文件册
            'files' => [
                'label' => "多图",
                'schema' => [
                    'type' => "string",
                    'length' => 50,
                ],
                'form' => [
                    'type' => "input",
                ],
                'grid' => []
            ],
        ];
    }
}
