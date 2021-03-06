<?php

Route::get("login", "LoginController@entry")->name("admin.login");
Route::post("login", "LoginController@login")->name("admin.login.do");
Route::post("logout", "LoginController@logout")->name("admin.logout");

Route::middleware("auth:admin")->group(function(){
    \Illuminate\Support\Facades\Route::get("/", function(){
        return redirect()->route('admin.home');
    });

    \Illuminate\Support\Facades\Route::get("home", "HomeController@home")->name("admin.home");

    \Illuminate\Support\Facades\Route::resource("menu", "AdminMenuController")->names("admin.menu");

    \Illuminate\Support\Facades\Route::resource("user", "AdminUserController")->names("admin.user");

    \Illuminate\Support\Facades\Route::resource("category", "CategoryController")->names("admin.category");

    \Illuminate\Support\Facades\Route::resource("article", "ArticleController")->names("admin.article");

    \Illuminate\Support\Facades\Route::resource("form", "FormController")->names("admin.form");
});

if(env("APP_DEBUG", false)){
    Route::get("/temp", function(){
        var_dump(\App\Admin\Models\AdminMenuView::tree());
    });
}
