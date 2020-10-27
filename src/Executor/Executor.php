<?php

namespace Phambinh217\LaravelPlus\Executor;

use Closure;

class Executor
{
    private $callback;

    public function __construct(Closure $callback)
    {
        $this->callback = $callback;
    }

    public function run()
    {
        $callback = $this->callback;
        return $callback();
    }
}
