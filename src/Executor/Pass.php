<?php

namespace Phambinh217\LaravelPlus\Executor;

use Closure;

class Pass extends Result
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
        return true;
    }

    public function isFail()
    {
        return !$this->isPass();
    }
}
