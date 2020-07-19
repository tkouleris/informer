<?php

namespace App\Providers;

use App\Utils\CachedGuzzleUtil;
use App\Utils\IGuzzle;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IGuzzle::class, CachedGuzzleUtil::class);
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
