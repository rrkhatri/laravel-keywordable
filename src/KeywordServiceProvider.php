<?php

namespace RrKhatri\Keywordable;

use Illuminate\Support\ServiceProvider;

class KeywordServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $modelPath = (file_exists(app_path() . '/Models'))
//            ? base_path('app/Models') : base_path('app');
//
//        // Publishing Model, Traits & Migrations
//        $this->publishes([
//            __DIR__ . '/../app'                 => $modelPath,
//            __DIR__ . '/../app/Traits'          => base_path('app/Traits'),
//            __DIR__.'/../database/migrations'   => base_path('database/migrations')
//        ]);

        $this->app->make('RrKhatri\Keywordable\Traits\Keywordable');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
