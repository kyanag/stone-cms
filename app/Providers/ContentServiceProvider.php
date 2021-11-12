<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Content;
use App\Models\Form;
use App\Models\FormField;
use App\Models\ModelForInspector;
use App\Observers\ContentModelObserver;
use App\Observers\FormSchemaFieldObserver;
use App\Observers\FormSchemaObserver;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{

    protected $contentModelClasses = [
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
        $this->bootEvents();
    }

    public function bootEvents(){
        Form::observe(FormSchemaObserver::class);
        FormField::observe(FormSchemaFieldObserver::class);

        foreach ($this->contentModelClasses as $contentModelClass){
            $contentModelClass::observe(ContentModelObserver::class);
        }
    }
}
