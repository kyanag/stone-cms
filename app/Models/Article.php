<?php

namespace App\Models;


use App\Models\Traits\Postable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use Postable;
    use SoftDeletes;

    protected $guarded = [];


    public function toPostArray()
    {
        return [
            'guid' => $this->guid,
            'post_title' => $this->title,
        ];
    }
}
