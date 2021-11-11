<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Content;
use App\Models\Form;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{

    protected $cidModels = [
        Category::class,
        Article::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCidModels();
        $this->bootContent();
    }

    public function bootContent(){
        Form::saved(function(Form $model){
            $table_name = $model->getTableNameAttribute();
            Schema::create($table_name, function(){

            });
        });
        Form::deleted(function(Form $model){
            $table_name = $model->getTableNameAttribute();
            Schema::dropIfExists($table_name);
        });
    }

    protected function bootCidModels(){
        foreach ($this->cidModels as $modelClass){
            $modelClass::creating(function($model){
                $model->cid = $this->createCid($model);
            });
            $modelClass::created(function($model){
                /** @var Article $model */
                $content = [
                    'cid' => $model['cid']
                ];
                $model->content()->create($content);
            });
        }
    }

    protected function createCid($model){
        return md5(uniqid(class_basename($model)));
    }
}
