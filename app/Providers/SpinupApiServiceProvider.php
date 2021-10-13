<?php

namespace App\Providers;

use App\Services\SpinupApiService;
use Illuminate\Support\ServiceProvider;

class SpinupApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SpinupApiService::class, function ($app) {
            return new SpinupApiService(config('spinup'));
        });
    }
}
