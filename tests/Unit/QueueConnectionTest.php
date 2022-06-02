<?php

use Carbon\CarbonInterval;
use Invi5h\LaravelStaticQueue\Queue;

it('makes valid connection', function () : void {
    config(['queue.connections' => array_merge(config('queue.connections'), ['static' => ['driver' => 'static']])]);
    $manager = app('queue');
    $connection = $manager->connection('static');
    expect($connection)->toBeInstanceOf(Queue::class);

    expect(fn() => $connection->clear('queue'))->toThrow(BadMethodCallException::class);
    expect(fn() => $connection->push('job'))->toThrow(BadMethodCallException::class);
    expect(fn() => $connection->pushOn('queue', 'job'))->toThrow(BadMethodCallException::class);
    expect(fn() => $connection->pushRaw('payload'))->toThrow(BadMethodCallException::class);
    expect(fn() => $connection->later(CarbonInterval::hour(), 'job'))->toThrow(BadMethodCallException::class);
    expect(fn() => $connection->laterOn('queue', CarbonInterval::hour(), 'job'))->toThrow(BadMethodCallException::class);
    expect(fn() => $connection->bulk(['job']))->toThrow(BadMethodCallException::class);

    expect($connection->size())->toBeZero();
    expect($connection->pop())->toBeNull();
});
