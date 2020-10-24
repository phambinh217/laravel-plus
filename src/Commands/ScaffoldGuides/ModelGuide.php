<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\ModelScaffold;

class ModelGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, ModelScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        $this->command->info('Model');
        $this->command->line("> 1. Open app/Models/{$variables['class']}.php and define \$fillable attribute");
    }
}
