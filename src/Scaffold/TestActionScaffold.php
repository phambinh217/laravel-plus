<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\Stub\Stub;
use Str;

class TestActionScaffold extends BaseScafflold
{
    private $basename;

    private function __construct($basename)
    {
        $this->basename = $basename;
    }

    public function getBasename()
    {
        return $this->basename;
    }

    public static function make($inputs)
    {
        return new static($inputs['basename']);
    }

    public function scaffold()
    {
        $variables = $this->variables();

        $mapStubToAction = [
            'Create' => 'tests/action.stub',
            'Update' => 'tests/action.stub',
            'Delete' => 'tests/action.stub',
        ];

        foreach ($mapStubToAction as $actionName => $stubPath) {
            $class = "{$actionName}{$variables['model']}ActionTest";
            $actionMethod = 'can_' . Str::slug($actionName) . '_' . $variables['view'];
            $action = "{$actionName}{$variables['model']}Action";

            Stub::make([
                'template' => file_get_contents($this->findStub($stubPath)),
                'data' => array_merge($variables, [
                    'class' => $class,
                    'actionMethod' => $actionMethod,
                    'action' => $action,
                ]),
                'output_path' => base_path("tests/Feature/Services/{$variables['model']}/Actions/{$class}.php"),
            ])->save();
        }
    }

    public function variables()
    {
        $model = Str::studly($this->basename);
        $service = Str::studly($this->basename) . 'Service'; // HelloWorldService
        $serviceVariable = Str::of($this->basename)->camel() . 'Service'; // helloWorldService
        $format = Str::studly($this->basename) . 'Format'; // HelloWorldFormat
        $formatVariable = Str::of($this->basename)->camel() . 'Format'; // helloWorldFormat
        $view = Str::slug(Str::snake($this->basename), '_'); // hello_world
        $modelVariable = Str::of($this->basename)->camel(); // helloWorld
        $modelVariablePlural = Str::plural($modelVariable); // helloWorlds
        $namespace = "Tests\Feature\Services\\$model\Actions";
        $rootNamespace = 'App\\';

        return compact([
            'service',
            'serviceVariable',
            'format',
            'formatVariable',
            'view',
            'modelVariable',
            'modelVariablePlural',
            'namespace',
            'rootNamespace',
            'model',
        ]);
    }
}
