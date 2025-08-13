<?php

declare(strict_types=1);

namespace Gridwb\LaravelMem0;

use Gridwb\LaravelMem0\Contracts\ApiClientContract;
use Gridwb\LaravelMem0\Contracts\ClientContract;
use Illuminate\Support\Facades\Config;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMem0ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-mem0')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(ApiClientContract::class, function (): ApiClient {
            /** @var string $apiUrl */
            $apiUrl = Config::get('mem0.api_url');
            /** @var string $apiKey */
            $apiKey = Config::get('mem0.api_key');

            return new ApiClient($apiUrl, $apiKey);
        });

        $this->app->singleton(ClientContract::class, Client::class);
        $this->app->alias(ClientContract::class, 'mem0');
    }
}
