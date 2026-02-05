<?php

namespace Mattsolar123\Perse\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mattsolar123\Perse\Services\AddressService;
use Mattsolar123\Perse\Tests\TestCase;
use Mattsolar123\Perse\Contracts\AddressServiceInterface;
use Mattsolar123\Perse\Data\AddressDetails;

class AddressServiceTest extends TestCase
{
    public function test_list_returns_response_body(): void
    {
        $mockBody = file_get_contents(__DIR__ . '/../Fixtures/address-list-response.json');
        $mock = new MockHandler([
            new Response(200, [], $mockBody),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $this->app->instance(AddressServiceInterface::class, new AddressService($client));

        $result = $this->app->make(AddressServiceInterface::class)->list();

        $this->assertSame(json_decode($mockBody, true), $result);
    }

    public function test_address_by_id_returns_response_body(): void
    {
        $mockBody = file_get_contents(__DIR__ . '/../Fixtures/address-by-id-response.json');
        $mock = new MockHandler([
            new Response(200, [], $mockBody),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $this->app->instance(AddressServiceInterface::class, new AddressService($client));

        $result = $this->app->make(AddressServiceInterface::class)->addressById(
            'Aua6auZouvLZuSzVnKvOsPWk3NezYMqq1w',
        );

        $bodyDecoded = json_decode($mockBody, true);

        $this->assertInstanceOf(AddressDetails::class, $result);
        $this->assertSame(
            $bodyDecoded['data']['address'],
            $result->address
        );
    }
}