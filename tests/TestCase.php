<?php

namespace Invi5h\LaravelStaticQueue\Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Invi5h\LaravelStaticQueue\ServiceProvider;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 *
 * @internal
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    use LazilyRefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
                ServiceProvider::class,
        ];
    }
}
