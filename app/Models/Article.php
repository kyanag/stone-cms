<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function content(){
        return $this->morphOne(Content::class, "content");
    }
}
