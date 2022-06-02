<?php

namespace Invi5h\LaravelStaticQueue;

use Invi5h\LaravelStaticQueue\Contracts\QueueServiceInterface;

class QueueService implements QueueServiceInterface
{
    /**
     * should be in the format ['queue-name' => [...jobs]]'.
     */
    private array $jobs = [];

    /**
     * {@inheritDoc}
     */
    public function job(callable|object|string $job, string $queue = null) : void
    {
        $this->push($job, $queue);
    }

    /**
     * {@inheritDoc}
     */
    public function push(callable|object|string $job, string $queue = null) : void
    {
        $this->jobs[$this->queue($queue)][] = $job;
    }

    /**
     * {@inheritDoc}
     */
    public function pushOn(string $queue, callable|object|string $job) : void
    {
        $this->push($job, $queue);
    }

    /**
     * {@inheritDoc}
     */
    public function bulk(array $jobs, string $queue = null) : void
    {
        foreach ($jobs as $job) {
            $this->push($job, $queue);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setQueue(string $queue, array $jobs) : void
    {
        $this->clear($queue);
        $this->bulk($jobs, $queue);
    }

    /**
     * {@inheritDoc}
     */
    public function clear(string $queue = null) : void
    {
        $this->jobs[$this->queue($queue)] = [];
    }

    /**
     * {@inheritDoc}
     */
    public function getJobs(string $queue = null) : array
    {
        return $this->jobs[$this->queue($queue)] ?? [];
    }

    /**
     * {@inheritDoc}
     */
    public function size(string $queue = null) : int
    {
        return count($this->getJobs($queue));
    }

    /**
     * {@inheritDoc}
     */
    public function pop(string $queue = null) : string|callable|object|null
    {
        if (0 === $this->size($queue)) {
            return null;
        }

        static $counter = 0;
        if (empty($this->getJobs($queue)[$counter])) {
            $counter = 0;
            return $this->pop($queue);
        }

        return $this->getJobs($queue)[$counter++];
    }

    protected function queue(string $queue = null) : string
    {
        return $queue ?? config('laravelstaticqueue.default_queue');
    }
}
