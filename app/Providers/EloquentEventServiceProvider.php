<?php

namespace App\Providers;

use App\Observers\RegisterUserObserver;
use App\User;
use Illuminate\Support\ServiceProvider;

class EloquentEventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(RegisterUserObserver::class);
    }
}
