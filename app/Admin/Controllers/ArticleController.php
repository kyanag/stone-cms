<?php


namespace App\Admin\Controllers;


use App\Admin\Models\ArticleView;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{

    use QuickControllerTrait;

    public function getModel($id = null)
    {
        return is_null($id) ? new ArticleView() : ArticleView::query()->find($id);
    }

}
