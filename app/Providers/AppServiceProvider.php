<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Article; //Importamos al modelo y al observador
use App\Observers\ArticleObserver; 

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
        Article::observe(ArticleObserver::class);
    }
}
