<?php

namespace Mattsolar123\Perse\Services;

use GuzzleHttp\ClientInterface;
use Mattsolar123\Perse\Services\AbstractPerseService;
use Mattsolar123\Perse\Contracts\AddressServiceInterface;
use Mattsolar123\Perse\Http\Endpoints;
use Mattsolar123\Perse\Data\AddressDetails;

class AddressService extends AbstractPerseService implements AddressServiceInterface
{
    public function list(string $postCode): array
    {
        return $this->getAsArray( Endpoints::ADDRESS_LIST, [
            'postCode' => $postCode
        ]);
    }

    public function addressById(string $addressId): AddressDetails
    {
        $response = $this->getAsArray( Endpoints::ADDRESS_BY_ID, [
            'addressId' => $addressId
        ]);
        
        return new AddressDetails(
            address: $response['data']['address'],
            mprn: $response['data']['mprn'],
            mpan: $response['data']['mpan'],
            fuelType: $response['data']['fuelType'],
            postCode: $response['data']['postCode'],
            uprn: $response['data']['uprn'],
        );
    }
}
