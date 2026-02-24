<?php

namespace App\Providers;

use App\Tenancy\TenantContext;
use App\Tenancy\TenantContextResolver;
use Illuminate\Support\ServiceProvider;

/**
 * @property \Illuminate\Contracts\Foundation\Application $app
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(TenantContext::class, fn (): TenantContext => TenantContext::empty());

        $this->app->singleton(TenantContextResolver::class, fn (): TenantContextResolver => new TenantContextResolver());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
