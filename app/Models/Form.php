<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Form extends Model
{

    protected $guarded = [];

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
}
