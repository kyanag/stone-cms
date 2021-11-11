<?php

namespace App\Providers;

use App\Admin\Supports\Tree;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
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
            $p->addFolder("custom", resource_path("templates"));
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
        $renderer->setCast("form", "custom::form");

        View::addNamespace("admin", resource_path("views/admin"));

        Collection::macro("toTreeList", function($name, $p_name, $p_id = 0){
            return (new Tree($this->items))->toTreeList(collect(), $name, $p_name, $p_id, 0);
        });

        UrlGenerator::macro("withQuery", function($url, $parameters = []){
            [$path, $qs] = $this->extractQueryString($url);

            if($qs == ""){
                $qs = "?";
            }
            $qs = $qs . http_build_query($parameters);
            return "{$path}{$qs}";
        });

        $this->bootValidatorRules();
    }


    public function bootValidatorRules(){
        Validator::extend("admin_username", function ($attribute, $value, $parameters, $validator) {
            if(is_null($value)){
                return true;
            }
            //字母开头  字母数字结尾  中间字母,数字,下划线   长度6-20
            return preg_match("/^[a-zA-Z][a-zA-Z0-9_]{4,18}[a-zA-Z0-9]$/", $value) == 1;
        });

        Validator::extend("admin_password", function ($attribute, $value, $parameters, $validator) {
            if(is_null($value)){
                return true;
            }
            //字母开头  字母数字结尾  中间字母,数字,下划线,点   长度6-20
            return preg_match("/^[a-zA-Z0-9][a-zA-Z0-9_\.]{4,18}[a-zA-Z0-9]$/", $value) == 1;
        });
    }
}