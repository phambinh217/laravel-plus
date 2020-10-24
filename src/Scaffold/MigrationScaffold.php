<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\Stub\Stub;
use Str;
use Artisan;

class MigrationScaffold extends BaseScafflold
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

        Artisan::call("make:migration {$variables['filename']}  --create={$variables['table']}");
    }

    public function variables()
    {
        $table = Str::plural(Str::slug(Str::snake($this->basename), '_')); // hello_worlds
        $filename = "create_{$table}_table";
        return compact([
            'table',
            'filename'
        ]);
    }
}
