<?php


namespace App\Admin\Models;

use App\Admin\Supports\ActiveForm;
use App\Admin\Supports\FormBuilder;
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


    public function inject(array $inputs)
    {
        $this->fill($inputs);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginator()
    {
        return $this->newQuery()->paginate();
    }

    public function showTitle()
    {
        return class_basename(static::class);
    }

    public function showDescription()
    {
        return $this->showTitle();
    }


    public function createFormBuilder($fields = [])
    {
        $builder = new FormBuilder($this->toArray());
        foreach ($fields as $field){
            $builder->add($field);
        }
        return $builder;
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
