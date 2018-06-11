<?php

namespace Chess\Chatkit;

use Illuminate\Support\ServiceProvider;

class ChatkitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/chatkit.php' => config_path('chatkit.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('chatkit', function ($app) {
            return new Chatkit($app->config->get('chatkit', []));
        });
    }
}