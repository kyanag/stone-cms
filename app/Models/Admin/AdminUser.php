<?php

namespace App\Models\Admin;

use App\Models\BaseModel as Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        //"password"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        //'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function(AdminUser $model){
            if($model->isDirty("password")){
                $model->password = Hash::make($model->password);
            }
        });
    }

    public function setUsernameAttribute($username){
        if(!$this->exists){
            $this->attributes['username'] = $username;
        }
    }

    public function setPasswordAttribute($password){
        if($password){
           $this->attributes['password'] = $password;
        }
    }

    public function getTitleAttribute(){
        return $this->nickname;
    }

    public function getRememberTokenName()
    {
        return null;
    }
}
