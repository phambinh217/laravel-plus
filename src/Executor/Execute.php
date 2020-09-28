<?php

namespace Phambinh217\LaravelPlus\Executor;

use Closure;

trait Execute
{
    public function execute(Closure $callback)
    {
        return (new Executor($callback))->run();
    }
}
