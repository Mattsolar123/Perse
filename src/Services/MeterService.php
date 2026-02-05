<?php

namespace Mattsolar123\Perse\Services;

use GuzzleHttp\ClientInterface;
use Mattsolar123\Perse\Services\AbstractPerseService;
use Mattsolar123\Perse\Http\Endpoints;
use Mattsolar123\Perse\Contracts\MeterServiceInterface;
use Mattsolar123\Perse\Enums\FuelType;
use Mattsolar123\Perse\Data\MeterDetails;

class MeterService extends AbstractPerseService implements MeterServiceInterface
{
    public function basicElectricityByAddressId(
        string $addressId,
    ): MeterDetails {
        $response = $this->postJsonAsArray( Endpoints::METER_DETAILS, [
            'fuelType' => FuelType::ELECTRICITY,
            'addressId' => $addressId,
            'customerConsent' => 'yes',
        ]);

        return new MeterDetails(
            mpanCore: $response['data'][0]['mpanCore'] ?? null,
            consumption: $response['data'][0]['consumption'] ?? 0,
        );
    }

    public function basicGasByAddressId(
        string $addressId,
    ): MeterDetails {
        $response = $this->postJsonAsArray( Endpoints::METER_DETAILS, [
            'fuelType' => FuelType::GAS,
            'addressId' => $addressId,
            'customerConsent' => 'yes',
        ]);

        return new MeterDetails(
            mpanCore: $response['data'][0]['mpanCore'] ?? null,
            consumption: $response['data'][0]['consumption'] ?? 0,
        );
    }

    public function fullMeterByMpan(
        string $mpan,
    ): MeterDetails {
        $response = $this->postJsonAsArray( Endpoints::FULL_METER_BY_MPAN_ADVANCED_PLUS, [
            'fuelType' => FuelType::ELECTRICITY,
            'mpan' => $mpan,
            'customerConsent' => 'yes',
        ]);

        return new MeterDetails(
            mpanCore: $response['data'][0]['mpanCore'] ?? null,
            consumption: $response['data'][0]['consumption'] ?? 0,
        );
        
    }
}
