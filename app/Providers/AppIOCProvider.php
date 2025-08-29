<?php

namespace App\Providers;

use App\Mappers\VendorMapper;
use App\Repositories\Interfaces\VendorRepositoryInterface;
use App\Repositories\VendorRepository;
use App\Services\Interfaces\VendorServiceInterface;
use App\Services\VendorService;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class AppIOCProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            abstract: VendorRepositoryInterface::class,
            concrete: fn() => new VendorRepository()
        );

        $this->app->bind(abstract: VendorMapper::class, concrete: fn() => new VendorMapper());

        $this->app->singleton(
            abstract: VendorServiceInterface::class,
            concrete: fn(Container $app) => new VendorService(
                vendorRepository: $app->make(abstract: VendorRepositoryInterface::class),
                vendorMapper: $app->make(abstract: VendorMapper::class)
            )
        );
    }

    public function boot(): void
    {
        //
    }
}
