<?php

namespace App\Providers;

use App\Admin\Supports\Tree;
use Illuminate\Support\Collection;
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
        require_once app_path("Admin/functions.php");
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

        Collection::macro("toTreeList", function($name, $p_name, $p_id = 0){
            return (new Tree($this->items))->toTreeList(collect(), $name, $p_name, $p_id, 0);
        });
    }
}