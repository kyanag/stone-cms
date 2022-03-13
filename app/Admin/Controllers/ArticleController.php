<?php
namespace App\Admin\Controllers;

use App\Admin\Interfaces\ModelProxy;
use App\Admin\ModelProxies\ArticleProxy;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Models\ArticleView;

class ArticleController extends ViewController
{

    /**
     * @var ModelProxy|Model
     */
    protected $proxy;

    /**
     * FormFieldController constructor.
     * @param ModelProxy $proxy
     */
    public function __construct(ArticleProxy $proxy)
    {
        $this->proxy = $proxy;
    }


    protected function getModelProxy()
    {
        return $this->proxy;
    }

}
