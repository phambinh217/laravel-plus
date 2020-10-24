<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\ServiceProvider;
use Phambinh217\LaravelPlus\Exceptions\StubNotFound;

abstract class BaseScafflold
{
    abstract public function scaffold();

    protected function findStub($relativeFilePath)
    {
        $paths = [
            base_path('stubs/laravel-plus'),
            ServiceProvider::ROOT_DIR . 'stubs/',
        ];

        foreach ($paths as $path) {
            $absolutePath = $path . $relativeFilePath;
            if (file_exists($absolutePath)) {
                return $absolutePath;
            }
        }

        throw new StubNotFound($relativeFilePath);
    }
}
