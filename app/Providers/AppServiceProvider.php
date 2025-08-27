<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\JWTAuthService;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(abstract: JWTAuthService::class, concrete: fn (Container $app): JWTAuthService => new JWTAuthService());
    }

    public function boot(): void
    {
        //
    }
}
