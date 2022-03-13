<?php
namespace App\Admin\Controllers;

use App\Admin\Interfaces\ModelProxy;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Models\CategoryView;

class CategoryController extends ViewController
{

    /**
     * @var ModelProxy|Model
     */
    protected $operator;

    /**
     * FormFieldController constructor.
     * @param ModelProxy $operator
     */
    public function __construct(CategoryView $operator)
    {
        $this->operator = $operator;
    }


    protected function getModelProxy()
    {
        return $this->operator;
    }

}
