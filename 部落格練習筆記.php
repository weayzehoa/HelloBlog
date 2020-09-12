<?php
/*
    1. 規劃與建立路由
*/
//首頁及搜尋，連接Home控制器路由
Route::get('/', 'HomeController@index')->name('index');
Route::get('search', 'HomeController@search')->name('search');

//登入登出，對應 Auth\LoginController
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//文章內容及類型，對應resource控制器，PostTypes控制器不需要產生index方法，所以用except來排除
//主要利用 php artisan make:controller PostsController --resource 直接產生七大function
//然後排除掉 index 不使用, 這樣就不用寫一堆route
Route::resource('posts', 'PostsController');
Route::resource('posts/types', 'PostTypesController', ['except' => ['index']]);
