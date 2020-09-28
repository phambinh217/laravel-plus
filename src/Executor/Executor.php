<?php

namespace Phambinh217\LaravelPlus\Executor;

use Closure;
use Exception;

class Executor
{
    private $callback;

    private $result;

    public function __construct(Closure $callback)
    {
        $this->callback = $callback;
    }

    public function run()
    {
        $pass = function ($value = null) {
            return new Pass($value);
        };

        $fail = function ($value = null) {
            return new Fail($value);
        };

        $callback = $this->callback;

       return $callback($pass, $fail);
    }
}
