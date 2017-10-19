<?php

namespace Eddie\Chuanglan;

use Illuminate\Support\ServiceProvider;

class ChuanglanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Chuanglan', function ($app) {
            return new Chuanglan($app);
        });
    }
}
