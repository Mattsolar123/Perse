<?php

namespace Mattsolar123\Perse\Contracts;

use Mattsolar123\Perse\Data\MeterDetails;

interface MeterServiceInterface
{
    public function meterDetails(
        string $mpan,
    ): MeterDetails;
}