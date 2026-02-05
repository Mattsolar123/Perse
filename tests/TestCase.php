<?php

namespace Mattsolar123\Perse\Tests;

use Mattsolar123\Perse\PerseServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'perse.url' => 'https://api.test.perse.com',
            'perse.api_key' => 'test-api-key',
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            PerseServiceProvider::class,
        ];
    }
}
