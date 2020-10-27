<?php

namespace Phambinh217\LaravelPlus\Executor;

class Result
{
    public static function success($value)
    {
        return new Success($value);
    }

    public static function error($message, $detailError = null)
    {
        return new Error($message, $detailError);
    }
}
