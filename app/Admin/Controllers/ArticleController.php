<?php
namespace App\Admin\Controllers;

use App\Admin\Interfaces\ResourceOperator;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Models\ArticleView;

class ArticleController extends ViewController
{

    /**
     * @var ResourceOperator|Model
     */
    protected $operator;

    /**
     * FormFieldController constructor.
     * @param ResourceOperator $operator
     */
    public function __construct(ArticleView $operator)
    {
        $this->operator = $operator;
    }


    protected function getResourceOperator()
    {
        return $this->operator;
    }

}