<?php

namespace Invi5h\LaravelStaticQueue\Tests\Mocks;

class InvokableTestJob
{
    public function __invoke() : void
    {
        echo 'Hello World';
    }
}
