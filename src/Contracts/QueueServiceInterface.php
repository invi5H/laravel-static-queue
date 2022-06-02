<?php

namespace Invi5h\LaravelStaticQueue\Contracts;

use Invi5h\LaravelStaticQueue\Job;

interface QueueServiceInterface
{
    /**
     * The job can be provided in any of the following ways -
     * object - a standard dispatchable laravel job class object with a public handle method
     * string - job class name resolved via the default service container or a standard php function name
     * callable - any standard php callable such as closure, arrow function, array syntax, class@method syntax, invokable object.
     */
    public function job(string|callable|array|object $job, string $queue = null) : void;

    /**
     * Alias to the above.
     */
    public function push(string|callable|array|object $job, string $queue = null) : void;

    /**
     * Pushes to a specific queue.
     */
    public function pushOn(string $queue, string|callable|array|object $job) : void;

    /**
     * Bulk pushes a list of jobs to the same queue.
     */
    public function bulk(array $jobs, string $queue = null) : void;

    /**
     * Resets the queue to the given set of jobs.
     */
    public function setQueue(string $queue, array $jobs) : void;

    /**
     * Clears the given queue.
     */
    public function clear(string $queue = null) : void;

    /**
     * Gets all the jobs for the given queue.
     */
    public function getJobs(string $queue = null) : array;

    /**
     * Gets the number of jobs for the given queue.
     */
    public function size(string $queue = null) : int;

    /**
     * Gets the next job in the given queue.
     */
    public function pop(string $queue = null) : Job;
}
