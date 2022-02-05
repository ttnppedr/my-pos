<?php

namespace App\Providers;

use App\Facades\CartHelper;
use Illuminate\Support\ServiceProvider;

class CartHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('carthelper', function () {
            return new CartHelper();
        });
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
