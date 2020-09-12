<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//這行別忘記寫進去
use \App\Http\ViewComposers\PostsIndexComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('posts.index', PostsIndexComposer::class);
    }
}
