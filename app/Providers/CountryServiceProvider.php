<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CountryService;


class CountryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CountryService::class, function ($app){
            return new CountryService();
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