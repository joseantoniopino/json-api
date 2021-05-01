<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Apartment\Repositories\ApartmentRepository;
use Src\Apartment\Repositories\ApartmentRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ApartmentRepositoryInterface::class,
            ApartmentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
