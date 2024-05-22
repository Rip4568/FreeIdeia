<?php

namespace App\Providers;

use App\Repositories\UserRespository;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRespository::class, function ($app) {
            return new UserRespository();
        });
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRespository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
