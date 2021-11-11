<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{

    protected $guarded = [];

    public function fields(){
        return $this->hasMany(FormField::class, "form_id", "id");
    }

    public function getTableNameAttribute(){
        return "c_{$this->name}";
    }
}
