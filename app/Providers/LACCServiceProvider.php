<?php

namespace LACC\Providers;

use Illuminate\Support\ServiceProvider;

class LACCServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \LaccUser\Repositories\UserRepository::class,
            \LaccUser\Repositories\UserRepositoryEloquent::class
        );
        $this->app->bind(
            \LACC\Repositories\StateRepository::class,
            \LACC\Repositories\StateRepositoryEloquent::class
        );
        $this->app->bind(
            \LACC\Repositories\AddressRepository::class,
            \LACC\Repositories\AddressRepositoryEloquent::class
        );
        $this->app->bind(
            \LACC\Repositories\CityRepository::class,
            \LACC\Repositories\CityRepositoryEloquent::class
        );
        $this->app->bind(
            \LACC\Repositories\TelephoneUserRepository::class,
            \LACC\Repositories\TelephoneUserRepositoryEloquent::class
        );
    }
}
