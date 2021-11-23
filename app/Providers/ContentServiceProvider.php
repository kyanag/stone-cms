<?php

namespace App\Providers;

use App\Admin\Content\HighTypeManager;
use App\Admin\Content\HighTypes\DatetimeProvider;
use App\Admin\Content\HighTypes\ImageProvider;
use App\Admin\Content\HighTypes\ImagesProvider;
use App\Admin\Content\HighTypes\NumberProvider;
use App\Admin\Content\HighTypes\StringProvider;
use App\Admin\Content\HighTypes\TextProvider;
use App\Admin\Models\FormFieldView;
use App\Admin\Models\FormView;
use App\Models\Article;
use App\Models\Category;
use App\Observers\ContentModelObserver;
use App\Observers\FormSchemaFieldObserver;
use App\Observers\FormSchemaObserver;
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

    private function bootHighTypes()
    {

    }

    private function bootEvents(){
//        FormView::observe(FormSchemaObserver::class);
//        FormFieldView::observe(FormSchemaFieldObserver::class);
        foreach ($this->contentModelClasses as $contentModelClass){
            $contentModelClass::observe(ContentModelObserver::class);
        }
    }
}
