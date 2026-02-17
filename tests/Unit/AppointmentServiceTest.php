<?php

namespace Mattsolar123\Perse\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mattsolar123\Perse\Services\AppointmentService;
use Mattsolar123\Perse\Tests\TestCase;
use Mattsolar123\Perse\Data\AppointmentDetails;

class AppointmentServiceTest extends TestCase
{
    public function test_update_appointment_returns_response_body(): void
    {
        $mockBody = file_get_contents(__DIR__ . '/../Fixtures/create-appointment-response.json');
        $mock = new MockHandler([
            new Response(200, [], $mockBody),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $appointmentService = new AppointmentService($client);

        $result = $appointmentService->update(
            new AppointmentDetails(
                appointmentDate: '2026-01-15',
                appointmentTimeFrom: '2026-01-01',
                appointmentTimeTo: '10:00',
                siteId: 1,
                customerGuid: 'Test appointment',
                appointmentId: '1234567890',
                appointmentStatus: 'pending',
                repId: 1,
                repEmailId: 'test@example.com',
                repFirstName: 'Test',
                repLastName: 'Test',
            ),
        );

        $bodyDecoded = json_decode($mockBody, true);
        $resultDecoded = json_decode($result->data, true);

        $this->assertSame(
            $bodyDecoded['data']['appointmentDate'],
            $resultDecoded['appointmentDate']
        );

        $this->assertSame(
            $bodyDecoded['data']['siteId'],
            $resultDecoded['siteId']
        );

        $this->assertSame(
            $bodyDecoded['data']['appointmentTimeTo'],
            $resultDecoded['appointmentTimeTo']
        );
    }
}
