<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Content extends Model
{
    //
    protected $fillable = [
        'cid',
    ];

    public function contentable(){
        return $this->morphTo("content");
    }

    public function category(){
        return $this->morphTo("content");
    }
}
