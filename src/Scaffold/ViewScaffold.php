<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\Stub\Stub;
use Str;

class ViewScaffold extends BaseScafflold
{
    private $basename;

    private function __construct($basename)
    {
        $this->basename = $basename;
    }

    public static function make($inputs)
    {
        return new static($inputs['basename']);
    }

    public function scaffold()
    {
        $variables = $this->variables();

        $mapStubToView = [
            'index' => 'views/index.stub',
            'show' => 'views/show.stub',
            'create' => 'views/create.stub',
            'update' => 'views/update.stub',
        ];

        foreach ($mapStubToView as $viewName => $stubPath) {
            Stub::make([
                'template' => file_get_contents($this->findStub($stubPath)),
                'data' => $variables,
                'output_path' => base_path("resources/views/{$variables['view']}/{$viewName}.php"),
            ])->save();
        }
    }

    public function variables()
    {
        $model = Str::studly($this->basename);
        $service = Str::studly($this->basename) . 'Service'; // HelloWorldService
        $serviceVariable = Str::of($this->basename)->camel() . 'Repo'; // helloWorldRepo
        $format = Str::studly($this->basename) . 'Format'; // HelloWorldFormat
        $formatVariable = Str::of($this->basename)->camel() . 'Format'; // helloWorldFormat
        $view = Str::slug(Str::snake($this->basename), '_'); // hello_world
        $modelVariable = Str::of($this->basename)->camel(); // helloWorld
        $modelVariablePlural = Str::plural($modelVariable); // helloWorlds
        $namespace = "App\Services\\$model";
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
