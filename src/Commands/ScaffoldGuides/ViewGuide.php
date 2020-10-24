<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\ViewScaffold;

class ViewGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, ViewScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        $this->command->info('View');
        $this->command->line("> Discover views at resources/views/{$variables['view']} to review views");
        $this->command->line("> Add template for index.blade.php - listing your resource");
        $this->command->line("> Add template for show.blade.php - show detail a resource");
        $this->command->line("> Add template for create.blade.php - form create new a resource");
        $this->command->line("> Add template for edit.blade.php - form update a resource");
    }
}
