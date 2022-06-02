<?php

namespace Invi5h\LaravelStaticQueue;

use BadMethodCallException;
use Illuminate\Contracts\Queue\ClearableQueue;
use Illuminate\Contracts\Queue\Queue as QueueInterface;
use Illuminate\Queue\Queue as BaseQueue;
use Invi5h\LaravelStaticQueue\Contracts\QueueServiceInterface;

class Queue extends BaseQueue implements QueueInterface, ClearableQueue
{
    /**
     * Create a new queue instance.
     */
    public function __construct(private readonly QueueServiceInterface $queueService, private readonly string $defaultQueue = 'default')
    {
    }

    /**
     * {@inheritDoc}
     */
    public function clear($queue) : never
    {
        throw new BadMethodCallException('Operation not allowed');
    }

    /**
     * {@inheritDoc}
     */
    public function size($queue = null) : int
    {
        return $this->queueService->size($queue ?? $this->defaultQueue);
    }

    /**
     * {@inheritDoc}
     */
    public function push($job, $data = '', $queue = null) : never
    {
        throw new BadMethodCallException('Operation not allowed');
    }

    /**
     * {@inheritDoc}
     */
    public function pushRaw($payload, $queue = null, array $options = []) : never
    {
        throw new BadMethodCallException('Operation not allowed');
    }

    /**
     * {@inheritDoc}
     */
    public function later($delay, $job, $data = '', $queue = null) : never
    {
        throw new BadMethodCallException('Operation not allowed');
    }

    /**
     * {@inheritDoc}
     */
    public function pop($queue = null) : ?Job
    {
        $job = $this->queueService->pop($queue ?? $this->defaultQueue);

        if (null === $job) {
            return null;
        }

        if (is_array($job) && is_callable($job)) {
            $job = $job(...);
        }

        return new Job($this->container, $this->createPayload($job, $queue ?? $this->defaultQueue, ''), $this->connectionName, $queue ?? $this->defaultQueue);
    }
}
