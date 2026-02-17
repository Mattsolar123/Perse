<?php

namespace Mattsolar123\Perse\Services;

use Mattsolar123\Perse\Services\AbstractPerseService;
use Mattsolar123\Perse\Contracts\AppointmentServiceInterface;
use Mattsolar123\Perse\Http\Endpoints;
use Mattsolar123\Perse\Data\AppointmentDetails;
use Mattsolar123\Perse\Data\AppointmentResponse;
use Mattsolar123\Perse\Libraries\CryptoJsAes;
use GuzzleHttp\Exception\RequestException;

class AppointmentService extends AbstractPerseService implements AppointmentServiceInterface
{
    public function update(
        AppointmentDetails $appointmentDetails,
    ): AppointmentResponse
    {
        try {
            $response = $this->postJsonAsArray(
                Endpoints::UPDATE_APPOINTMENT . '?utmSource=' . getenv('PERSE_UTM_SOURCE'),
                $appointmentDetails->toArray()
            );
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $statusCode = $response?->getStatusCode() ?? 500;
            $body = $response !== null
                ? $response->getBody()->getContents()
                : $e->getMessage();
            return new AppointmentResponse(
                httpStatusCode: $statusCode,
                data: $body ?: 'Internal Server Error',
                loginUrl: null
            );
        }

        $bodyContents = $response->getBody()->getContents();
        $data = json_decode($bodyContents, true)['data'] ?? [];

        return new AppointmentResponse(
            httpStatusCode: $response->getStatusCode(),
            data: json_encode($data),
            loginUrl: $this->getLoginUrl($data)
        );
    }

    public function getLoginUrl(array $response): string|null
    {
        return isset($response) && isset($response['repLoginUrl']) ?
            CryptoJsAes::decrypt($response['repLoginUrl'], getenv('PERSE_SECRET')) : null;
    }
}
