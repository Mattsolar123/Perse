<?php

namespace Mattsolar123\Perse;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\ClientInterface;
use Mattsolar123\Perse\Contracts\MeterServiceInterface;
use Mattsolar123\Perse\Services\AddressService;
use Mattsolar123\Perse\Services\MeterService;

class PerseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/perse.php', 'perse');

        $this->publishes([
            __DIR__.'/../config/perse.php' => config_path('perse.php'),
        ], 'perse-config');

        // Register the API client once (singleton or bind).
        $this->app->singleton(ClientInterface::class, function ($app) {
            return new Client([
                'base_uri' => config('perse.url'),
                'headers' => [
                    'x-api-key' => config('perse.api_key'),
                ],
            ]);
        });

        $this->app->singleton(MeterServiceInterface::class, MeterService::class);

        // MeterService (and any future service) just receives it.
        $this->app->singleton(MeterService::class, function ($app) {
            return new MeterService($app->make(ClientInterface::class));
        });

        $this->app->singleton(AddressService::class, function ($app) {
            return new AddressService($app->make(ClientInterface::class));
        });
    }

    public function boot()
    {
        //
    }
}
