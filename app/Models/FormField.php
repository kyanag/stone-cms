<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Kyanag\Form\Core\Widget;

class FormField extends Model
{
    //

    public function form()
    {
        return $this->belongsTo(Form::class, "form_id", "id");
    }



    public function runSchemaColumn(Blueprint $table)
    {

    }

    public function dropSchemaColumn(Blueprint $table)
    {
        $table->dropColumn($this->name);
    }

    /**
     * @return ColumnDefinition
     */
    public function toSchemaColumn()
    {
        return new ColumnDefinition([
            'name' => $this->name,
            'type' => "string",
            'length' => 255,
            'comment' => $this->desc,
        ]);
    }

    /**
     * @return Widget | array
     */
    public function toFormField()
    {
        return [
            'type' => "input",
            'name' => $this->name,
            'label' => $this->title,
        ];
    }

    /**
     * @return array
     */
    public function toGridColumn()
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
        ];
    }

    /**
     * 提供的字段类型
     * @return array
     */
    public static function types(){
        return [
            'string' => "",         //文本
            'text' => "",           //长文本
            'number' => "",         //数字类型
            'datetime' => "",       //时间
            'image' => "",          //图片类型
            'images' => "",         //图册类型
            'file' => "",           //文件
            'files' => "",          //文件册
        ];
    }
}
