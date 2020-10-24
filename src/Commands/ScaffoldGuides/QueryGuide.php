<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\QueryScaffold;

class QueryGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, QueryScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        $this->command->info('Query');
        $this->command->line("> 1. Open app/Services/{$variables['model']}/{$variables['class']}.php and define query methods");
    }
}
