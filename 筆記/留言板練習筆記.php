<?php
/*
    在部落格上面加上留言版
    1. 修改 Route
*/

//文章內容及類型，對應resource控制器，PostTypes控制器不需要產生index方法，所以用except來排除
//主要利用 php artisan make:controller PostsController --resource 直接產生七大function
//然後排除掉 index 不使用, 這樣就不用寫一堆route
Route::resource('posts', 'PostsController');
Route::resource('posts/types', 'PostTypesController', ['except' => ['index']]);

//首頁及搜尋，連接Home控制器路由
Route::get('/', 'HomeController@index')->name('index');
Route::get('search', 'HomeController@search')->name('search');

//改用使用預設的Auth所有路由
Auth::routes();
//登入登出，對應 Auth\LoginController
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//文章內容及類型，對應resource控制器，PostTypes控制器不需要產生index方法，所以用except來排除
//主要利用 php artisan make:controller PostsController --resource 直接產生七大function
//然後排除掉 index 不使用, 這樣就不用寫一堆route
Route::resource('posts', 'PostsController');
Route::resource('posts/types', 'PostTypesController', ['except' => ['index']]);

//新增留言板用resource路由
//路由形式會是 posts/{post}/comments , 因為留言是隸屬post之下
Route::resource('posts.comments', 'PostCommentsController', ['only' => ['store', 'destroy']]);

//處理顯示與上傳使用者頭像路由
Route::prefix('users')->name('users.')->group(function(){
    Route::get('avatar', 'UsersController@showAvatar')->name('showAvatar');
    Route::post('avatar', 'UsersController@uploadAvatar')->name('uploadAvatar');
});

//訪客身分使用第三方登入路由
Route::prefix('login/social')->name('social.')->group(function(){
    Route::get('{provider}/redirect', 'Auth\SocialController@getSocialRedirect')->name('redirect');
    Route::get('{provider}/callback', 'Auth\SocialController@getSocialCallback')->name('callback');
});
