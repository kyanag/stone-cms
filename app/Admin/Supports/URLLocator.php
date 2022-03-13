<?php


namespace App\Admin\Supports;


use App\Admin\Admin;
use Illuminate\Database\Eloquent\Model;

/**
 * Class URLLocator
 * @package App\Admin\Supports
 *
 * @method static URLLocator article()
 * @method static URLLocator post()
 * @method static URLLocator user()
 */
class URLLocator
{

    protected static $locators = [];

    protected $meta;

    public function __construct(ResourceMeta $meta)
    {
        $this->meta = $meta;
    }

    /**
     * @param $name
     * @return static
     */
    public static function __callStatic($name, $arguments)
    {
        return static::getLocator($name);
    }

    /**
     * @param $name
     * @return static
     */
    public static function getLocator($name)
    {
        if(!isset(static::$locators[$name]))
        {
            $meta = Admin::resource($name);
            static::$locators[$name] = new static($meta);
        }
        return static::$locators[$name];
    }

    public static function getLocators()
    {
        return static::$locators;
    }

    protected function route($name, ...$args)
    {
        $name = $this->meta->getRoute($name);

        return route($name, ...$args);
    }

    public function index()
    {
        return $this->route("index");
    }

    public function create()
    {
        return $this->route("create");
    }

    public function edit($model_or_pk)
    {
        return $this->route("edit", $model_or_pk);
    }

    public function show($model_or_pk)
    {
        return $this->route("show", $model_or_pk);
    }

    public function destroy($model_or_pk)
    {
        return $this->route("destroy", $model_or_pk);
    }
}
