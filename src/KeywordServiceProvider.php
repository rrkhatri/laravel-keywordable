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
                __DIR__.'/../src/app' => base_path('app/Models'),
            ]);
        } else {
            $this->publishes([
                __DIR__.'/../src/app' => base_path('app'),
            ]);
        }

        // Publishing Trait
        $this->publishes([
            __DIR__.'/../src/trait' => base_path('app/Traits'),
        ]);
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
