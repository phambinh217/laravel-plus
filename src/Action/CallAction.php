<?php

namespace Phambinh217\LaravelPlus\Actions;

trait CallAction
{
    public function callAction($actionPath)
    {
        return app($actionPath);
    }
}
