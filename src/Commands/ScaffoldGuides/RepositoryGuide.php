<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\RepositoryScaffold;

class RepositoryGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, RepositoryScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        // $this->command->line("> Repository guides: Open controller at {$variables['savePath']} and review all methods");
    }
}
