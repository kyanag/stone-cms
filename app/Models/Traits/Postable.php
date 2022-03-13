<?php


namespace App\Models\Traits;


use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Trait Postable
 * @package App\Models\Traits
 *
 * @mixin Model
 */
trait Postable
{

    public static function bootPostable()
    {
        static::creating(function(Model $model){
            if(!$model->isDirty("guid")){
                $model->guid = Str::uuid()->getHex();
            }
        });
    }

    public function post(){
        return $this->morphOne(Post::class, "post");
    }

    abstract public function toPostArray();
}
