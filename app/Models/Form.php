<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{


    public function fields(){
        return $this->hasMany(FormField::class, "form_id", "id");
    }
}
