<?php
namespace App\Admin\Controllers;

use App\Admin\Interfaces\ModelProxy;
use App\Admin\ModelProxies\AdminUserProxy;
use App\Admin\ModelProxies\ArticleProxy;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Models\AdminUserView;

class AdminUserController extends ViewController
{

    /**
     * @var ModelProxy|Model
     */
    protected $operator;

    /**
     * FormFieldController constructor.
     * @param ModelProxy $operator
     */
    public function __construct(AdminUserProxy $operator)
    {
        $this->operator = $operator;
    }


    protected function getModelProxy()
    {
        return $this->operator;
    }

}
