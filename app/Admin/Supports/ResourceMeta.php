<?php


namespace App\Admin\Supports;


use Illuminate\Support\Facades\Route;

class ResourceMeta
{

    protected $id;

    protected $model;

    protected $name;

    protected $route_options = [
        'uri' => null,
        'controller' => null,
        'as' => null
    ];

    protected $routes = [];

    protected $view_options = [
        'model_proxy' => null,
    ];

    public function __construct($id, $model, $name = null)
    {
        $this->id = $id;
        $this->model = $model;
        $this->name = $name ?: $id;

        $this->initRouteOptions();
        $this->initViewOptions();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function toRoute()
    {
        list(
            'uri' => $uri,
            'controller' => $controller,
            'as' => $as
        ) = $this->route_options;

        $this->routes = collect([
            'index' => null,
            'create' => null,
            'edit' => null,
            'show' => null,
            'store' => null,
            'update' => null,
            'destroy' => null,
        ])->map(function($item, $key) use($as){
            return "{$as}.{$key}";
        });
        return Route::resource($uri, $controller)->names($as);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRoute($name)
    {
        return $this->routes[$name] ?? null;
    }

    protected function initRouteOptions()
    {
        $controller = class_basename($this->model) . "Controller";
        $as = "admin.{$this->id}";
        $this->route_options = [
            'uri' => $this->id,
            'controller' => $controller,
            'as' => $as
        ];
    }

    protected function initViewOptions()
    {
        $class_basename = class_basename($this->model);
        $model_proxy = "App\\Admin\\ModelProxies\\{$class_basename}Proxy";

        $this->view_options = [
            'model_proxy' => $model_proxy,
        ];
    }
}
