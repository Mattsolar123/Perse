<?php

namespace Mattsolar123\Perse\Facades;

use Illuminate\Support\Facades\Facade;
use Mattsolar123\Perse\Contracts\MeterServiceInterface;

/**
 * @see \Mattsolar123\Perse\Services\MeterService
 */
class PerseMeterDetails extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MeterServiceInterface::class;
    }
}
