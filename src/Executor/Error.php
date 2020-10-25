<?php

namespace Phambinh217\LaravelPlus\Executor;

use Closure;
use Throwable;

class Error extends Result
{
    public $detailError;

    public $errorMessage;

    public function __construct($errorMessage, $detailError = null)
    {
        $this->errorMessage = $errorMessage;
        $this->detailError = $detailError;
    }

    public function getValue()
    {
        return $this->detailError;
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
