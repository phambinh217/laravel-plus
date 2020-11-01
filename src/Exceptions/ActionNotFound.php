<?php

namespace Phambinh217\LaravelPlus\Exceptions;

use Exception;

class ActionNotFound extends Exception
{
    public function __construct($actionName)
    {
        parent::__construct("Can not find any action named: $actionName");
    }
}
