<?php


namespace App\Providers;


use App\Etherium\EhteriumManager;
use App\Etherium\EtheriumProvider;
use Illuminate\Support\ServiceProvider;

class EtheriumServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EtheriumProvider::class, function ($app) {
            return new EhteriumManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

}
