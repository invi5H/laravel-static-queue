<?php

namespace Invi5h\LaravelStaticQueue;

use Illuminate\Queue\Jobs\SyncJob;

class Job extends SyncJob
{
    /**
     * {@inheritDoc}
     */
    public function getQueue() : string
    {
        return $this->queue;
    }
}
