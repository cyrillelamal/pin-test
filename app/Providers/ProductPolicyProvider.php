<?php

namespace App\Providers;

use App\Policies\ProductPolicy;
use Illuminate\Support\ServiceProvider;

class ProductPolicyProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ProductPolicy::class, function () {
            return new ProductPolicy(
                config('products.role')
            );
        });
    }
}
