<?php

Route::get("login", "LoginController@entry")->name("admin.login");
Route::post("login", "LoginController@login")->name("admin.login.do");

Route::middleware("auth:admin")->group(function(){
    \Illuminate\Support\Facades\Route::get("home", "HomeController@home")->name("admin.home");

});