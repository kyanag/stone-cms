<?php


namespace App\Admin\Models;

use App\Admin\Elements\Form;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * @return Model
     */
    public function getRecord(){
        return $this;
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
