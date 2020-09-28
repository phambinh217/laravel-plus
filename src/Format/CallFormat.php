<?php

namespace Phambinh217\LaravelPlus\Formats;

trait CallFormat
{
    public function callFormat($formatPath)
    {
        return app($formatPath);
    }
}
