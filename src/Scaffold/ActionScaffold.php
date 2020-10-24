<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\Stub\Stub;
use Str;

class ActionScaffold extends BaseScafflold
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
            'Create' => 'actions/create.stub',
            'Update' => 'actions/update.stub',
            'Delete' => 'actions/delete.stub',
        ];

        foreach ($mapStubToAction as $actionName => $stubPath) {
            $class = "{$actionName}{$variables['model']}Action";

            Stub::make([
                'template' => file_get_contents($this->findStub($stubPath)),
                'data' => array_merge($variables, [
                    'class' => $class
                ]),
                'output_path' => app_path("Repositories/{$variables['model']}/Actions/{$class}.php"),
            ])->save();
        }
    }

    public function variables()
    {
        $model = Str::studly($this->basename);
        $repository = Str::studly($this->basename) . 'Repository'; // HelloWorldRepository
        $repositoryVariable = Str::of($this->basename)->camel() . 'Repo'; // helloWorldRepo
        $format = Str::studly($this->basename) . 'Format'; // HelloWorldFormat
        $formatVariable = Str::of($this->basename)->camel() . 'Format'; // helloWorldFormat
        $view = Str::slug(Str::snake($this->basename), '_'); // hello_world
        $modelVariable = Str::of($this->basename)->camel(); // helloWorld
        $modelVariablePlural = Str::plural($modelVariable); // helloWorlds
        $namespace = "App\Repositories\\$model";
        $rootNamespace = 'App\\';

        return compact([
            'repository',
            'repositoryVariable',
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
