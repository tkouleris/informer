<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ICountryRepository;
use App\Repositories\Interfaces\ISettingRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICountryRepository::class, CountryRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ISettingRepository::class, SettingRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
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
