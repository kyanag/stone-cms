<?php


namespace App\Admin\Controllers;


use App\Admin\Models\FormView;
use App\Http\Controllers\Controller;

class FormController extends Controller
{

    use QuickControllerTrait;

    protected function getModel($id = null)
    {
        if(is_null($id)){
            return new FormView();
        }
        return FormView::query()->find($id);
    }
}
