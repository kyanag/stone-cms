<?php

Route::get("login", "LoginController@entry")->name("admin.login");
Route::post("login", "LoginController@login")->name("admin.login.do");
Route::post("logout", "LoginController@logout")->name("admin.logout");

Route::middleware("auth:admin")->group(function(){
    \Illuminate\Support\Facades\Route::get("home", "HomeController@home")->name("admin.home");

    \Illuminate\Support\Facades\Route::resource("menu", "AdminMenuController")->names("admin.menu");
});

if(env("APP_DEBUG", false)){
    Route::get("/temp", function(){
        return \Illuminate\Support\Facades\Cache::tags("admin")->remember("admin1", 1, function(){
            return time();
        });
    });
}