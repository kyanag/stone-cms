<?php


namespace App\Admin\Supports;

use App\Admin\Interfaces\ViewModelInterface;
use App\Admin\Models\ViewModel;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ViewModelScenarioDecorator implements ViewModelInterface
{
    /**
     * @var ViewModel
     */
    protected $vmInstance;

    protected $scenario;

    public function __construct(ViewModel $vmModel)
    {
        $this->vmInstance = $vmModel;
    }


    public function withScenario($scenario)
    {
        $this->scenario = $scenario;
        return $this;
    }


    public function getViewModel(){
        return $this->vmInstance;
    }

    public function withModel($model)
    {
        if($model instanceof Model){

        }else{
            $model = $this->vmInstance::query()->find($model);
            if(is_null($model)){
                throw new NotFoundHttpException();
            }
        }
        $this->vmInstance = $model;
        return $this;
    }

    public function toForm()
    {
        return $this->vmInstance->toForm();
    }

    public function toGrid()
    {
        return $this->vmInstance->toGrid();
    }
}