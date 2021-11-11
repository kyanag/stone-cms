<?php


namespace App\Admin\Controllers;


use App\Admin\Models\CategoryView;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    use QuickControllerTrait;


    protected function getModel($id = null)
    {
        if($id){
            return CategoryView::query()->find($id);
        }else{
            return CategoryView::newModel();
        }
    }
}
