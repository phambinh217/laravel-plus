<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\MigrationScaffold;

class MigrationGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, MigrationScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        $this->command->info('Migration');
        $this->command->line("> 1. Open database/migrations/{$variables['filename']}.php and define your up and down methods");
        $this->command->line("> 2. Run php artisan migrate");
    }
}
