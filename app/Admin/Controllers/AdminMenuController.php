<?php


namespace App\Admin\Controllers;


use App\Admin\Models\AdminMenuView;
use App\Http\Controllers\Controller;

class AdminMenuController extends Controller
{

    use QuickControllerTrait;

    protected function getViewModel($id = null)
    {
        if(is_null($id)){
            return new AdminMenuView();
        }
        return AdminMenuView::query()->find($id);
    }
}
