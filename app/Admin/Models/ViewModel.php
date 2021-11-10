<?php


namespace App\Admin\Models;


use App\Admin\Models\ModelPlugs\ValidatePlug;
use App\Admin\Widgets\Form;
use App\Admin\Widgets\Grid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Kyanag\Form\Core\Widget;

/**
 * Trait ViewModel
 * @package App\Admin\Models
 * @mixin Model
 */
trait ViewModel
{
    use ValidatePlug;


    protected $pageSize = 10;

    /**
     * 场景 用于
     * @var mixed
     */
    protected $scenario = null;

    public function withScenario($scenario){
        $this->scenario = $scenario;
        return $this;
    }


    /**
     * 数据保存
     * @return bool
     */
    public function persist()
    {
        return $this->commit()->save();
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function persistOrFail(){
        return $this->commit()->saveOrFail();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginator()
    {
        return $this->newQuery()->paginate($this->pageSize);
    }

    public function showTitle()
    {
        return class_basename(static::class);
    }

    public function showDescription()
    {
        return $this->showTitle();
    }

    /**
     * @return Form
     * @throws \Exception
     */
    public function toForm()
    {
        $class = static::class;
        throw new \Exception("{$class}::toForm not exists!");
    }

    /**
     * @return Widget | Grid
     */
    public function toGrid()
    {
        $class = static::class;
        throw new \Exception("{$class}::toGrid not exists!");
    }

    public function toGridForm()
    {
        return $this->toForm()->withAttribute("submitText", "搜索");
    }

    public function toView()
    {
        return $this->toForm();
    }

    public static function newModel()
    {
        return new static();
    }
}
