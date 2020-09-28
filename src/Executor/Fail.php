<?php

namespace Phambinh217\LaravelPlus\Executor;

use Closure;

class Fail extends Result
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

    public function isPass()
    {
        return false;
    }

    public function isFail()
    {
        return !$this->isPass();
    }
}
