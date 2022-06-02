<?php

namespace Invi5h\LaravelStaticQueue;

use Illuminate\Contracts\Queue\Job as QueueJobInterface;

class Job implements QueueJobInterface
{
    /**
     * {@inheritDoc}
     */
    public function uuid()
    {
        // TODO: Implement uuid() method.
    }

    /**
     * {@inheritDoc}
     */
    public function getJobId()
    {
        // TODO: Implement getJobId() method.
    }

    /**
     * {@inheritDoc}
     */
    public function payload()
    {
        // TODO: Implement payload() method.
    }

    /**
     * {@inheritDoc}
     */
    public function fire()
    {
        // TODO: Implement fire() method.
    }

    /**
     * {@inheritDoc}
     */
    public function release($delay = 0)
    {
        // TODO: Implement release() method.
    }

    /**
     * {@inheritDoc}
     */
    public function isReleased()
    {
        // TODO: Implement isReleased() method.
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * {@inheritDoc}
     */
    public function isDeleted()
    {
        // TODO: Implement isDeleted() method.
    }

    /**
     * {@inheritDoc}
     */
    public function isDeletedOrReleased()
    {
        // TODO: Implement isDeletedOrReleased() method.
    }

    /**
     * {@inheritDoc}
     */
    public function attempts()
    {
        // TODO: Implement attempts() method.
    }

    /**
     * {@inheritDoc}
     */
    public function hasFailed()
    {
        // TODO: Implement hasFailed() method.
    }

    /**
     * {@inheritDoc}
     */
    public function markAsFailed()
    {
        // TODO: Implement markAsFailed() method.
    }

    /**
     * {@inheritDoc}
     */
    public function fail($e = null)
    {
        // TODO: Implement fail() method.
    }

    /**
     * {@inheritDoc}
     */
    public function maxTries()
    {
        // TODO: Implement maxTries() method.
    }

    /**
     * {@inheritDoc}
     */
    public function maxExceptions()
    {
        // TODO: Implement maxExceptions() method.
    }

    /**
     * {@inheritDoc}
     */
    public function timeout()
    {
        // TODO: Implement timeout() method.
    }

    /**
     * {@inheritDoc}
     */
    public function retryUntil()
    {
        // TODO: Implement retryUntil() method.
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        // TODO: Implement getName() method.
    }

    /**
     * {@inheritDoc}
     */
    public function resolveName()
    {
        // TODO: Implement resolveName() method.
    }

    /**
     * {@inheritDoc}
     */
    public function getConnectionName()
    {
        // TODO: Implement getConnectionName() method.
    }

    /**
     * {@inheritDoc}
     */
    public function getQueue()
    {
        // TODO: Implement getQueue() method.
    }

    /**
     * {@inheritDoc}
     */
    public function getRawBody()
    {
        // TODO: Implement getRawBody() method.
    }
}
