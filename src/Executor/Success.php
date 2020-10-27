<?php

namespace Phambinh217\LaravelPlus\Executor;

class Success
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
        return true;
    }

    public function hasError()
    {
        return !$this->isSuccess();
    }
}
