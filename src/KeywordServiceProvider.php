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
        if (!class_exists('CreateKeywordsTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__.'/../database/migrations/create_keywords_table.php' =>
                    database_path('migrations/'.$timestamp.'_create_keywords_table.php'),
            ], 'migrations');
        }
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
