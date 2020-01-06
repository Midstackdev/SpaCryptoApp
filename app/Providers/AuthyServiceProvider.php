<?php

namespace App\Providers;

use App\TwoFactor\Authy\AuthyService;
use Authy\AuthyApi;
use Illuminate\Support\ServiceProvider;

class AuthyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('authy', function () {
            $client = new AuthyApi(config(services.authy.secret));

            return new AuthyService($client);
        })
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
