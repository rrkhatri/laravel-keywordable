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
        // Publishing Model
        if (file_exists(app_path() . '/Models')) {
            $this->publishes([
                __DIR__ . '/../app' => base_path('app/Models'),
            ]);
        } else {
            $this->publishes([
                __DIR__ . '/../app' => base_path('app'),
            ]);
        }

        // Publishing Trait
        $this->publishes([
            __DIR__ . '/../app/Traits' => base_path('app/Traits'),
        ]);

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
