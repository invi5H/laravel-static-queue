<?php

namespace Invi5h\LaravelStaticQueue\Tests\Mocks;

class TestJob
{
    public function handle() : void
    {
        echo 'Hello World';
    }
}
