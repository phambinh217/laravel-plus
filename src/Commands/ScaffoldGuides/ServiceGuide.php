<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\ServiceScaffold;

class ServiceGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, ServiceScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        // $this->command->line("> Service guides: Open controller at {$variables['savePath']} and review all methods");
    }
}
