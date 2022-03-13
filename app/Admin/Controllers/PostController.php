<?php
namespace App\Admin\Controllers;

use App\Admin\Interfaces\ModelProxy;
use App\Admin\ModelProxies\ArticleProxy;
use App\Admin\ModelProxies\PostProxy;
use Illuminate\Database\Eloquent\Model;

class PostController extends ViewController
{

    /**
     * @var ModelProxy|Model
     */
    protected $operator;

    /**
     * FormFieldController constructor.
     */
    public function __construct()
    {
        $this->operator = new PostProxy();
    }


    protected function getModelProxy()
    {
        return $this->operator;
    }

}
