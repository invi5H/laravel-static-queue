<?php

namespace Invi5h\LaravelStaticQueue;

use Illuminate\Queue\Connectors\ConnectorInterface;
use Invi5h\LaravelStaticQueue\Contracts\QueueServiceInterface;

class Connector implements ConnectorInterface
{
    /**
     * {@inheritDoc}
     */
    public function connect(array $config) : Queue
    {
        return new Queue(app(QueueServiceInterface::class), $config['queue'] ?? 'default');
    }
}
