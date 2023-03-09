<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\HotelService;

class HotelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HotelService::class, function ($app){
            return new HotelService();
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