<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {
            $curUrl = \Illuminate\Support\Facades\URL::current();
            $view->with('currentUrl', $curUrl);

            $hasError = session()->has('error');
            $hasSuccess = session()->has('success');

            $snackbarText = $hasError ? session()->get('error', '') : session()->get('success', '');

            $showSnackbar = $hasError || $hasSuccess;

            $errorColor = '#B71C1C';
            $successColor = '#66BB6A';

            $view->with('errorColor', $errorColor);
            $view->with('successColor', $successColor);
            $view->with('showSnackbar', $showSnackbar);
            $view->with('snackbarText', $snackbarText);
            $view->with('hasError', $hasError);
            $view->with('hasSuccess', $hasSuccess);

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
