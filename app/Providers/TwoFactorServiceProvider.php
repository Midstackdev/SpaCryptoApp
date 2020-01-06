<?php

namespace App\Providers;

use App\TwoFactor\Authy\AuthyService;
use App\TwoFactor\TwoFactor;
use Authy\AuthyApi;
use Illuminate\Support\ServiceProvider;

class TwoFactorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TwoFactor::class, function () {
            $client = new AuthyApi(config('services.authy.secret'));

            return new AuthyService($client);
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
