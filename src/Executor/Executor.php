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
        $success = function ($value = null) {
            return new Success($value);
        };

        $error = function ($message, $detailError = null) {
            return new Error($message, $detailError);
        };

        $callback = $this->callback;

       return $callback($success, $error);
    }
}
