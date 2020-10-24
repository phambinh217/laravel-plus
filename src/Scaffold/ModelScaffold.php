<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\Stub\Stub;
use Str;
use Artisan;

class ModelScaffold extends BaseScafflold
{
    private $basename;

    private function __construct($basename)
    {
        $this->basename = $basename;
    }

    public static function make($inputs)
    {
        return new static($inputs['basename']);
    }

    public function scaffold()
    {
        $variables = $this->variables();
        Artisan::call("make:model {$variables['class']}");
    }

    public function variables()
    {
        $class = Str::studly($this->basename);

        return compact([
            'class'
        ]);
    }
}
