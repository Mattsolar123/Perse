<?php

namespace Mattsolar123\Perse\Data;

class AddressDetails
{
    public function __construct(
        public string|null $addressId = null,
        public string|null $address = null,
        public array|null $mprn = null,
        public array|null $mpan = null,
        public string|null $fuelType = null,
        public string|null $postCode = null,
        public string|null $uprn = null,
    ) {}
}
