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

/*
    2.產生資料表
    在產生資料表之前要先設定 .env 並在資料庫建立相對應的設定
    DB_PORT=3306
    DB_DATABASE=HelloBlog
    DB_USERNAME=root
    DB_PASSWORD=
    然後使用
    php artisan make:migration create_posts_table --create=posts
    php artisan make:migration create_post_types_table --create=post_types
    建立兩個 migration
    建立好後，到 database\migrations 中找到
    [timestamp]_create_posts_table.php
    [timestamp]_create_post_types_table.php
    並在裡面增加要的資料結構
*/
/*
    create_posts_table.php
*/
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('type')->unsigned()->nullable();
            $table->text('content')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }
/*
    create_post_types_table.php
*/
    public function up()
    {
        Schema::create('post_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }
/*
    建立好後，使用
    php artisan migrate
    產生資料表欄位, 這時候 Laravel 會將 database\目錄下的所有table結構建立起來
    包括新開專案中的users及password_resets與failed_jobs
    進入資料庫中確認是否已經建立完成.
*/
