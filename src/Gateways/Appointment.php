<?php

namespace Mattsolar123\Perse\Gateways;

use Mattsolar123\Perse\Services\AppointmentService;
use Mattsolar123\Perse\Data\AppointmentDetails;
use GuzzleHttp\Client;

class Appointment
{
    public static function update(AppointmentDetails $appointmentDetails): AppointmentDetails
    {
        $url = getenv('PERSE_API_URL');
        $key = getenv('PERSE_API_KEY');

        $client = new Client([
            'base_uri' => $url,
            'headers' => [
                'api_key' => $key,
            ],
        ]);

        $appointmentService = new AppointmentService($client);
        
        return $appointmentService->update($appointmentDetails);
    }
}