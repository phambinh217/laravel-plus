<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\ActionScaffold;

class ActionGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, ActionScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        $this->command->info('Action');
        $this->command->line("> Discover actions at app/Services/{$variables['model']}/Actions to review actions");
        $this->command->line("> Add query options for Query{$variables['model']}Action.php");
        $this->command->line("> Add validate for Create{$variables['model']}Action.php");
        $this->command->line("> Add validate for Update{$variables['model']}Action.php");
        $this->command->line("> Add validate for Delete{$variables['model']}Action.php");
    }
}
