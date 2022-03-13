<?php

Route::get("login", "LoginController@entry")->name("admin.login");
Route::post("login", "LoginController@login")->name("admin.login.do");
Route::post("logout", "LoginController@logout")->name("admin.logout");

Route::middleware("auth:admin")->group(function(){
    \Illuminate\Support\Facades\Route::get("/", function(){
        return redirect()->route('admin.home');
    });

    \Illuminate\Support\Facades\Route::get("home", "HomeController@home")->name("admin.home");
    \Illuminate\Support\Facades\Route::get("config/all", "ConfigController@view")->name("admin.config.view");
    \Illuminate\Support\Facades\Route::put("config/all", "ConfigController@update")->name("admin.config.update");

    \App\Admin\Admin::resources()->getRoutes();
});

if(env("APP_DEBUG", false)){
    Route::get("/temp", function(){
        var_dump(\App\Admin\Models\AdminMenuView::tree());
    });
}
