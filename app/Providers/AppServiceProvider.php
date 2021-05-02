<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Apartment\Repositories\ApartmentRepository;
use Src\Apartment\Repositories\ApartmentRepositoryInterface;
use Src\Category\Repositories\CategoryRepository;
use Src\Category\Repositories\CategoryRepositoryInterface;

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
