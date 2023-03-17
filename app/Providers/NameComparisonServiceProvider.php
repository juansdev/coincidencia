<?php

namespace App\Providers;

use App\Services\NameComparisonService;
use Illuminate\Support\ServiceProvider;

class NameComparisonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NameComparisonService::class, function ($app) {
            return new NameComparisonService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
