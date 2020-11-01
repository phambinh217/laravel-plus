<?php

namespace Phambinh217\LaravelPlus\Service;

use Phambinh217\LaravelPlus\Exceptions\ActionNotFound;

abstract class BaseService
{
    protected $actions = [
        //
    ];

    public function __call($method, $params = null)
    {
        if (isset($this->actions[$method])) {
            return app($this->actions[$method])->handle(...$params);
        }

        throw new ActionNotFound($method);
    }
}
