<?php


namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home(){
        session()->flash("danger", "test-delay");
        return view("admin::home");
    }

}