<?php

namespace Phambinh217\LaravelPlus\Executor;

use Closure;

class Error extends Result
{
    private $value;

    public function __construct($value = null)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isSuccess()
    {
        return false;
    }

    public function hasError()
    {
        return !$this->isSuccess();
    }
}
