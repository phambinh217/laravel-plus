<?php

namespace Phambinh217\LaravelPlus\Executor;

use Throwable;
use Illuminate\Support\Arr;

abstract class Result
{
    abstract public function isPass();

    abstract public function isFail();

    abstract public function getValue();
}
