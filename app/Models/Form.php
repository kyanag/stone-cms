<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Form extends Model
{

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::created(function(Form $form){
            $form->migrate();
        });
        static::deleted(function(Form $form){
            $form->migrateRollback();
        });
    }

    public function fields()
    {
        return $this->hasMany(FormField::class, "form_id", "id");
    }

    public function tableName()
    {
        return static::encodeTableName($this->name);
    }


    public static function encodeTableName($form_name)
    {
        return "c_{$form_name}";
    }

    public static function decodeTableName($en_form_name)
    {
        return substr($en_form_name, 2);
    }

    /**
     * 在数据库生效
     * @param bool $exists
     */
    public function migrate($exists = false){
        $table_name = $this->tableName();
        Schema::create($table_name, function(Blueprint $table){
            $table->string("cid", 20)->comment("内容id");

            $table->softDeletes();
            $table->primary("cid");
        });
        if($exists){
            /** @var FormField $field */
            foreach($this->fields as $field){
                $field->migrate();
            }
        }
    }

    /**
     * 回滚
     */
    public function migrateRollback(){
        $table_name = $this->tableName();
        Schema::dropIfExists($table_name);
    }
}
