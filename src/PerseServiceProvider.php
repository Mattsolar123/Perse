<?php

namespace Mattsolar123\Perse;

use Illuminate\Support\ServiceProvider;
use Mattsolar123\Perse\Services\ApiService;

class PerseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ApiService::class, function ($app) {
            return new ApiService();
        });
    }

    public function boot()
    {
        //
    }
}
