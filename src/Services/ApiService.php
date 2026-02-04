<?php

namespace Mattsolar123\Perse\Services;

use GuzzleHttp\Client;

class ApiService
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function get()
    {
        $response = $this->client->post('https://api.perse.com/v1/token', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);
    }
}
