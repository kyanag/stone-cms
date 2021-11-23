<?php

namespace App\Models;

use App\Admin\Models\FormFieldView;
use App\Models\BaseModel as Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Support\Facades\Schema;

class FormField extends Model
{
    //
    protected $guarded = [];

    protected $attributes = [
        'settings' => "[]",
        'rules' => "[]",
        'desc' => ""
    ];

    protected $casts = [
        'settings' => "array",
        'rules' => "[]",
    ];

    protected static function boot()
    {
        parent::boot();
        static::saved(function(FormField $field){
            $field->migrate();
        });
        static::deleted(function(FormField $field){
            $field->migrateRollback();
        });
    }

    public function form()
    {
        return $this->belongsTo(Form::class, "form_id", "id");
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

    public function migrate(){
        /** @var Form $form */
        $form = $this->form;
        Schema::table($form->tableName(), function(Blueprint $table){
            /** @var ColumnDefinition $column */
            $column = $this->toSchemaColumn()->before("deleted_at");

            $table->addColumn($column->get("type"), $column->get("name"), $column->getAttributes());
        });
    }

    public function migrateRollback(){
        /** @var Form $form */
        $form = $this->form;
        Schema::table($form->tableName(), function(Blueprint $table){
            $column = $this->toSchemaColumn();
            $table->dropColumn($column->get("name"));
        });
    }
}
