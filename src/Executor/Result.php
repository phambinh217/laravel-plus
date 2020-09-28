<?php

namespace Phambinh217\LaravelPlus\Executor;

use Throwable;
use Illuminate\Support\Arr;

abstract class Result
{
    abstract public function isSuccess();

    abstract public function hasError();

    abstract public function getValue();

    public function getError()
    {
        return $this->getValue();
    }
}
