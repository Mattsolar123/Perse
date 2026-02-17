<?php

namespace Mattsolar123\Perse\Data;

class AppointmentResponse
{
    public function __construct(
        public int $httpStatusCode,
        public string $data,
        public string|null $loginUrl,
    ) {}
}