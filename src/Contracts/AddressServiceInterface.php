<?php

namespace Mattsolar123\Perse\Contracts;

use Mattsolar123\Perse\Data\AddressDetails;

interface AddressServiceInterface
{
    public function list(): array;

    public function addressById(string $addressId): AddressDetails;
}