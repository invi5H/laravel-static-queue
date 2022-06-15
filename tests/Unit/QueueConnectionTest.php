<?php

use Carbon\CarbonInterval;
use Invi5h\LaravelStaticQueue\Contracts\QueueServiceInterface;
use Invi5h\LaravelStaticQueue\Job;
use Invi5h\LaravelStaticQueue\Queue;
use Invi5h\LaravelStaticQueue\Tests\Mocks\InvokableTestJob;
use Invi5h\LaravelStaticQueue\Tests\Mocks\TestJob;

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

it('runs jobs properly', function () : void {
    /** @var QueueServiceInterface $service */
    $service = app(QueueServiceInterface::class);
    $service->job(new TestJob());
    $service->job(TestJob::class);
    $service->job(function () : void {
        echo 'Hello World';
    });
    $service->job(fn() => print 'Hello World');
    $service->job((new TestJob())->handle(...));
    $service->job(TestJob::class.'@handle');
    $service->job([new TestJob(), 'handle']);
    $service->job(new InvokableTestJob());

    config(['queue.connections' => array_merge(config('queue.connections'), ['static' => ['driver' => 'static']])]);
    $manager = app('queue');
    $connection = $manager->connection('static');
    expect($connection->size())->toBe(8);
    for ($i = 0; $i < 8; ++$i) {
        $job = $connection->pop();
        expect($job)->toBeInstanceOf(Job::class);
        expect($job->getQueue())->toBe('default');
        ob_start();
        $job->fire();
        expect(ob_get_clean())->toBe('Hello World');
    }
    $job = $connection->pop();
    expect($job)->toBeInstanceOf(Job::class);
    expect($job->getQueue())->toBe('default');
    ob_start();
    $job->fire();
    expect(ob_get_clean())->toBe('Hello World');
});
