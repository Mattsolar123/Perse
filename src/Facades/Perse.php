<?php

namespace Mattsolar123\Perse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mattsolar123\Perse\Services\ApiService
 */
class Perse extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Mattsolar123\Perse\Services\ApiService::class;
    }
}
