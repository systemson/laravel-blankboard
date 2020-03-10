<?php

namespace Systemson\Blankboard;

use Illuminate\Support\ServiceProvider as ParentProvider;
use Illuminate\Support\Facades\Route;

/**
 * 
 */
class ServiceProvider extends ParentProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'blankboard');

        $this->publishes([
            __DIR__.'/public' => public_path(),
        ], 'public');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang'),
        ]);
    }
}