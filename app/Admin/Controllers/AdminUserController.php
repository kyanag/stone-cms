<?php


namespace App\Admin\Controllers;


use App\Admin\Models\AdminUserView;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{

    use QuickControllerTrait;

    protected function getViewModel($id = null)
    {
        if($id){
            return AdminUserView::query()->find($id);
        }else{
            return AdminUserView::newModel();
        }
    }
}
