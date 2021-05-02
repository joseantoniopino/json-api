<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Apartment\Infrastructure\Repositories\{ApartmentRepository, ApartmentRepositoryInterface};
use Src\Category\Infrastructure\Repositories\{CategoryRepository, CategoryRepositoryInterface};

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

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
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
