<?php

namespace Invi5h\LaravelStaticQueue\Facades;

use Illuminate\Support\Facades\Facade;
use Invi5h\LaravelStaticQueue\Contracts\QueueServiceInterface;
use Invi5h\LaravelStaticQueue\QueueService;

/**
 * @mixin QueueService
 */
class Queue extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return QueueServiceInterface::class;
    }
}
