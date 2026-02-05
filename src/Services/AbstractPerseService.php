<?php

namespace Mattsolar123\Perse\Services;

use GuzzleHttp\ClientInterface;

abstract class AbstractPerseService
{
    public function __construct(
        protected ClientInterface $client
    ) {}

    protected function postJson(string $path, array $body): string
    {
        $response = $this->client->post($path, ['json' => $body]);
        return (string) $response->getBody();
    }

    protected function postJsonAsArray(string $path, array $body): array
    {
        $response = $this->client->post($path, ['json' => $body]);
        return json_decode((string) $response->getBody(), true);
    }

    protected function getAsArray(string $path, array $query): array
    {
        $response = $this->client->get($path, ['query' => $query]);
        return json_decode((string) $response->getBody(), true);
    }
}
