<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Kyanag\Form\Core\Factory;
use Kyanag\Form\Core\Renderer;
use League\Plates\Engine;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("renderer", function(){

            $p = Factory::createEngine();
            $p->addFolder("stone", resource_path("templates"));
            return new Renderer($p);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var Renderer $renderer */
        $renderer = $this->app->get("renderer");
        $renderer->setCast("form", "stone::form");

        View::addNamespace("admin", resource_path("views/admin"));
    }
}