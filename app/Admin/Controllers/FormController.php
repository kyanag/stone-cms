<?php
namespace App\Admin\Controllers;

use App\Admin\Interfaces\ResourceOperator;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Models\FormView;

class FormController extends ViewController
{

    /**
     * @var ResourceOperator|Model
     */
    protected $operator;

    /**
     * FormFieldController constructor.
     * @param ResourceOperator $operator
     */
    public function __construct(FormView $operator)
    {
        $this->operator = $operator;
    }


    protected function getResourceOperator()
    {
        return $this->operator;
    }

    public function show($id)
    {
        $operator = $this->getResourceOperator()
            ->withModel($id);

        return view("admin::form.show", [
            'model' => $operator,
        ]);
    }
}
