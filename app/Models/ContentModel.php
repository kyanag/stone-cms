<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

abstract class ContentModel extends Model
{

    public function content(){
        return $this->morphOne(Content::class, "content");
    }

}