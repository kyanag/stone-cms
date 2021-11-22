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
        $operator->form_id = request()->route("form");
        $this->operator = $operator;
    }


    protected function getResourceOperator()
    {
        return $this->operator;
    }

}
