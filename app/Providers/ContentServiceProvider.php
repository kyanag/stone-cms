<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Content;
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
        $this->app->singleton("inspectorProvider", function($app){

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCidModels();
        $this->bootContentInspectors();
    }

    protected function bootContentInspectors(){

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
