<?php


namespace App\Admin\Models;


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

    protected $pageSize = 10;

    /**
     * 待校验的输入数据
     * @var array
     */
    protected $inputs = [];

    /**
     * 场景 用于
     * @var mixed
     */
    protected $scenario = null;


    public function withInputs(array $inputs)
    {
        $this->inputs = $inputs;
        return $this;
    }

    public function withScenario($scenario)
    {
        $this->scenario = $scenario;
        return $this;
    }

    /**
     * @return array
     */
    public function getInputs()
    {
        return $this->inputs ?: [];
    }

    protected function fillInputs()
    {
        $this->fill($this->inputs);
        $this->inputs = null;
    }

    public function getRules()
    {
        return [];
    }

    /**
     * 数据保存
     * @return bool
     */
    public function persist()
    {
        $this->fillInputs();
        return $this->save();
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function persistOrFail(){
        $this->fillInputs();
        return $this->saveOrFail();
    }

    /**
     * @return bool
     * @throws ValidationException
     */
    public function verified()
    {
        $validator = Validator::make($this->inputs, $this->getRules());
        if($validator->fails()){
            throw new ValidationException($validator);
        }
        $this->inputs = $validator->validated();
        return true;
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
