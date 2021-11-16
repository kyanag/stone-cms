<?php
namespace App\Admin\Controllers;

use App\Admin\Interfaces\ResourceOperator;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Models\FormFieldView;

class FormFieldController extends ViewController
{

    /**
     * @var ResourceOperator|Model
     */
    protected $operator;

    /**
     * FormFieldController constructor.
     * @param ResourceOperator $operator
     */
    public function __construct(FormFieldView $operator)
    {
        //var_dump(request()->route());exit();
        $operator->model_id = 1;
        $this->operator = $operator;
    }


    protected function getResourceOperator()
    {
        return $this->operator;
    }

}
