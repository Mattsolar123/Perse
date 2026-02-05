<?php

namespace Mattsolar123\Perse\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mattsolar123\Perse\Services\MeterService;
use Mattsolar123\Perse\Tests\TestCase;
use Mattsolar123\Perse\Contracts\MeterServiceInterface;
use Mattsolar123\Perse\Data\MeterDetails;

class MeterServiceTest extends TestCase
{
    public function test_full_meter_by_mpan_returns_response_body(): void
    {
        $mockBody = file_get_contents(__DIR__ . '/../Fixtures/full-meter-by-mpan-response.json');
        $mock = new MockHandler([
            new Response(200, [], $mockBody),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $this->app->instance(MeterServiceInterface::class, new MeterService($client));

        $result = $this->app->make(MeterServiceInterface::class)->meterDetails(
            '1012394107989',
        );

        $bodyDecoded = json_decode($mockBody, true);

        $this->assertInstanceOf(MeterDetails::class, $result);
        $this->assertSame(
            $bodyDecoded['data'][0]['consumption'],
            $result->consumption
        );
    }
}
