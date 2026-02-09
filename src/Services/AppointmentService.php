<?php

namespace Mattsolar123\Perse\Services;

use Mattsolar123\Perse\Services\AbstractPerseService;
use Mattsolar123\Perse\Contracts\AppointmentServiceInterface;
use Mattsolar123\Perse\Http\Endpoints;
use Mattsolar123\Perse\Data\AppointmentDetails;
use Mattsolar123\Perse\Libraries\CryptoJsAes;

class AppointmentService extends AbstractPerseService implements AppointmentServiceInterface
{
    public function update(
        AppointmentDetails $appointmentDetails,
    ): AppointmentDetails
    {
        $response = $this->postJsonAsArray(
            Endpoints::UPDATE_APPOINTMENT,
            $appointmentDetails->toArray()
        );

        return new AppointmentDetails(
            appointmentDate: $response['data']['appointmentDate'],
            appointmentTimeFrom: $response['data']['appointmentTimeFrom'],
            appointmentTimeTo: $response['data']['appointmentTimeTo'],
            siteId: $response['data']['siteId'],
            customerGuid: $response['data']['customerGuid'],
            appointmentId: $response['data']['appointmentId'],
            appointmentStatus: $response['data']['appointmentStatus'],
            repId: $response['data']['repId'] ?? null,
            repEmailId: $response['data']['repEmailId'] ?? null,
            repFirstName: $response['data']['repFirstName'] ?? null,
            repLastName: $response['data']['repLastName'] ?? null,
            loginUrl: $this->getLoginUrl($response),
        );
    }

    public function getLoginUrl(array $response): string|null
    {
        return isset($response['data']) && isset($response['data']['repLoginUrl']) ?
            CryptoJsAes::decrypt($response['data']['repLoginUrl'], getenv('PERSE_SECRET')) : null;
    }
}
