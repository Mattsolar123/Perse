<?php

namespace Mattsolar123\Perse\Gateways;

use Mattsolar123\Perse\Services\AppointmentService;
use Mattsolar123\Perse\Data\AppointmentDetails;
use Mattsolar123\Perse\Data\AppointmentResponse;
use GuzzleHttp\Client;

class Appointment
{
    private $httpStatusCode;
    private $response;
    private $loginUrl;

    public static function update(AppointmentDetails $appointmentDetails): AppointmentResponse
    {
        $url = getenv('PERSE_API_URL');
        $key = getenv('PERSE_API_KEY');

        $client = new Client([
            'base_uri' => $url,
            'headers' => [
                'api_key' => $key,
                'Content-Type' => 'application/json'
            ],
        ]);

        $appointmentService = new AppointmentService($client);
        
        return $appointmentService->update($appointmentDetails);
    }

    public static function getLoginUrl(string $response): string|null
    {
        $appointmentService = new AppointmentService($client);

        return $appointmentService->getLoginUrl(json_decode($response, true));
    }
}