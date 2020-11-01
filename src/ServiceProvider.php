<?php

namespace Phambinh217\LaravelPlus;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Commands\MakeAuthCommand;
use Phambinh217\LaravelPlus\Commands\MakeUiCommand;

class ServiceProvider extends BaseServiceProvider
{
    const ROOT_DIR = __DIR__ . '/../';
    const SRC_DIR = __DIR__ . '/';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ScaffoldingCommand::class,
                MakeAuthCommand::class,
                MakeUiCommand::class,
            ]);
        }
    }
}
