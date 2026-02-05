<?php

namespace Mattsolar123\Perse\Tests\Feature;

use Mattsolar123\Perse\Services\MeterService;
use Mattsolar123\Perse\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function test_config_is_merged(): void
    {
        $this->assertSame('https://api.test.perse.com', config('perse.url'));
        $this->assertSame('test-api-key', config('perse.api_key'));
    }

    public function test_meter_service_is_registered_as_singleton(): void
    {
        $first = $this->app->make(MeterService::class);
        $second = $this->app->make(MeterService::class);

        $this->assertInstanceOf(MeterService::class, $first);
        $this->assertSame($first, $second);
    }
}
