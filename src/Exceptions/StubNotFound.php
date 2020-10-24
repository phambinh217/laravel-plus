<?php

namespace Phambinh217\LaravelPlus\Exceptions;

use Exception;

class StubNotFound extends Exception
{
    public function __construct($filename)
    {
        parent::__construct("Can not find any stub file named: $filename");
    }
}
