<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Exception;

class ScaffoldGuide
{
    private $command;

    private $guideSections = [
        'migration' => MigrationGuide::class,
        'model' => ModelGuide::class,
        'action' => ActionGuide::class,
        'test_action' => TestActionGuide::class,
        'controller' => ControllerGuide::class,
        'view' => ViewGuide::class,
    ];

    public function __construct(ScaffoldingCommand $command)
    {
        $this->command = $command;
    }

    public function writeDown()
    {
        $this->command->alert('Thank you for using Laravel Plus. Next, check guidelines bellow:');

        foreach ($this->guideSections as $section => $class) {
            if (!isset($this->command->scaffold[$section])) {
                continue;
            }

            $scaffold = $this->command->scaffold[$section];
            (new $class($this->command, $scaffold))->writeDown();

            $this->command->line(PHP_EOL);
        }
    }
}
