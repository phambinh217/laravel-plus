<?php

namespace Phambinh217\LaravelPlus\Commands;

use Illuminate\Console\Command;
use Str;
use Phambinh217\LaravelPlus\Scaffold;
use Phambinh217\LaravelPlus\Commands\ScaffoldGuides\ScaffoldGuide;

class ScaffoldingCommand extends Command
{
    protected $signature = 'scaffold';
    protected $description = 'Generate service';

    protected $basename;
    protected $createModel = false;
    protected $createMigration = false;
    protected $createCurdActions = false;
    protected $createFormat = false;
    protected $createController = false;
    protected $createService = false;
    protected $createView = false;
    protected $controllerReturn = 'json';

    public $scaffold = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->createInputs();
        $this->scaffold();
        $this->guide();
    }

    private function createInputs()
    {
        $this->basename = $this->ask('What is your object name?. Eg: User, Article, Product');
        $this->createModel = $this->confirm('Do you want to create a model?');
        $this->createMigration = $this->confirm('Do you want create a migration?');
        $this->createCurdActions = $this->confirm('Do you want create CURD actions?');
        $this->createFormat = $this->confirm('Do you want create a resource format?');
        $this->createService = $this->confirm('Do you want create a service?');

        if ($this->createCurdActions) {
            $this->createController = $this->confirm('Do you want create a controller?');
        } else {
            $this->createController = false;
        }

        // if ($this->createController) {
        //     $this->controllerReturn = $this->choice('What your controller return?', ['json', 'view'], 0);
        // }

        if ($this->controllerReturn == 'view') {
            $this->createView = $this->confirm('Do you want create views?');
        }
    }

    private function scaffold()
    {
        if ($this->createModel) {
            $this->scaffold['model'] = Scaffold\ModelScaffold::make(['basename' => $this->basename]);
        }

        if ($this->createMigration) {
            $this->scaffold['migration'] = Scaffold\MigrationScaffold::make(['basename' => $this->basename]);
        }

        if ($this->createController) {
            $this->scaffold['controller'] = Scaffold\ControllerScaffold::make(['basename' => $this->basename])->setReturnType($this->controllerReturn);
        }

        if ($this->createView) {
            $this->scaffold['view'] = Scaffold\ViewScaffold::make(['basename' => $this->basename]);
        }

        if ($this->createFormat) {
            $this->scaffold['format'] = Scaffold\FormatScaffold::make(['basename' => $this->basename]);
        }

        if ($this->createService) {
            $this->scaffold['service'] = Scaffold\ServiceScaffold::make(['basename' => $this->basename])->useAction($this->createCurdActions);
        }

        if ($this->createCurdActions) {
            $this->scaffold['action'] = Scaffold\ActionScaffold::make(['basename' => $this->basename]);
        }

        foreach ($this->scaffold as $scaffold) {
            $scaffold->scaffold();
        }
    }

    private function guide()
    {
        return (new ScaffoldGuide($this))->writeDown();
    }
}
