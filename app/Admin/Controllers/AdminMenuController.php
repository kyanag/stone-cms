<?php


namespace App\Admin\Controllers;


use App\Admin\Models\AdminMenuView;
use App\Admin\Supports\Factory;
use App\Admin\Supports\ModelRepository;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminMenu;
use Illuminate\Http\Request;

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
