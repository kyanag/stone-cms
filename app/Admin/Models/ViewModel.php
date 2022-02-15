<?php


namespace App\Admin\Models;

use App\Admin\Elements\ActiveForm;
use App\Admin\Supports\FormBuilder;
use App\Admin\Supports\GridBuilder;
use App\Admin\Widgets\Column;
use App\Admin\Elements\Form\Form;
use App\Admin\Elements\Grid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Kyanag\Form\Core\Widget;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Trait ViewModel
 * @package App\Admin\Models
 * @mixin Model
 */
trait ViewModel
{

    public function withRecord($record)
    {
        $record = $this->newQuery()->find($record);
        if(is_null($record)){
            throw new NotFoundHttpException();
        }
        return $record;
    }


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
}
