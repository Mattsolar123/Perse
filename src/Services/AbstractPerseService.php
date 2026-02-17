<?php

namespace Mattsolar123\Perse\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

abstract class AbstractPerseService
{
    public function __construct(
        protected ClientInterface $client,
    ) {}

    protected function postJsonAsArray(string $path, array $body): Response
    {
        $response = $this->client->post(
            $path,
            [
                'json' => $body
            ]
        );

        return $response;
    }

    protected function getAsArray(string $path, array $body): array
    {
        $response = $this->client->get(
            $path,
            [
                'json' => $body
            ]
        );

        $responseBody = $response->getBody()->getContents();
        $responseBodyDecoded = json_decode($responseBody, true);

        return $responseBodyDecoded;
    }
}
