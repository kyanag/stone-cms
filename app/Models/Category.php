<?php

namespace App\Models;

use App\Admin\Supports\Tree;
use App\Models\Admin\AdminMenu;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    //
    protected $guarded = [];

    public function content(){
        return $this->morphOne(Content::class, "content");
    }
}
