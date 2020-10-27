<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\TestActionScaffold;

class TestActionGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, TestActionScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        $this->command->info('Test (optional)');
        $this->command->line("> Discover actions at test/Feature/Services/{$variables['model']}/Actions to review tests");
        $this->command->line("> Define test case for Create{$variables['model']}ActionTest.php");
        $this->command->line("> Define test case for Update{$variables['model']}ActionTest.php");
        $this->command->line("> Define test case for Delete{$variables['model']}ActionTest.php");
    }
}
