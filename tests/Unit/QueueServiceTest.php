<?php

use Invi5h\LaravelStaticQueue\Contracts\QueueServiceInterface;
use Invi5h\LaravelStaticQueue\Facades\Queue;

it('has valid service', function () : void {
    $service = app(QueueServiceInterface::class);
    expect($service)->toBeInstanceOf(QueueServiceInterface::class);

    expect(Queue::getFacadeRoot())->toBe($service);
});

it('is accepting jobs onto queue', function () : void {
    /** @var QueueServiceInterface $service */
    $service = app(QueueServiceInterface::class);
    expect($service->size())->toBeZero();

    $service->job(fn() => print 'test');
    expect($service->size())->toBeOne();

    $service->setQueue('abcd', [fn() => print 'test']);
    $service->pushOn('abcd', fn() => print 'test');
    expect($service->size('abcd'))->toBe(2);
});
