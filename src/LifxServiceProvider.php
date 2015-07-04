<?php

namespace Kz\Lifx;

use Illuminate\Support\ServiceProvider;


class LifxServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/lifx.php', 'lifx'
        );
        $this->app->bind('Lifx', function($app) {
            return new Lifx(config('lifx.token'));
        });
    }
    public function provides()
    {
        return ['Lifx'];
    }

}