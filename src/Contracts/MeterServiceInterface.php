<?php

namespace Mattsolar123\Perse\Contracts;

use Mattsolar123\Perse\Data\MeterDetails;

interface MeterServiceInterface
{
    public function basicElectricityByAddressId(
        string $addressId,
    ): MeterDetails;

    public function basicGasByAddressId(
        string $addressId,
    ): MeterDetails;

    public function fullMeterByMpan(
        string $mpan,
    ): MeterDetails;
}