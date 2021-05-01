<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use ReflectionException;
use Src\JsonApi\JsonApiBuilder;

class JsonApiServiceProvider extends ServiceProvider
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
     * @throws ReflectionException
     */
    public function boot()
    {
        Builder::mixin(new JsonApiBuilder());
    }
}
