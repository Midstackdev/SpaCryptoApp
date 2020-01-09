<?php

namespace App\Providers;

use App\Service\Bitgo\BitgoService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class BitgoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BitgoService::class, function() {
            return new BitgoService(new Client);
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
