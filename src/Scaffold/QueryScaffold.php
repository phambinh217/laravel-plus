<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\Stub\Stub;
use Str;

class QueryScaffold extends BaseScafflold
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

        Stub::make([
            'template' => file_get_contents($this->findStub('query.stub')),
            'data' => $variables,
            'output_path' => $variables['savePath'],
        ])->save();
    }

    public function variables()
    {
        $model = Str::studly($this->basename);
        $class = Str::studly($this->basename) . 'Query'; // HelloWorldService
        $service = Str::studly($this->basename) . 'Service'; // HelloWorldService
        $serviceVariable = Str::of($this->basename)->camel() . 'Repo'; // helloWorldRepo
        $format = Str::studly($this->basename) . 'Format'; // HelloWorldFormat
        $formatVariable = Str::of($this->basename)->camel() . 'Format'; // helloWorldFormat
        $view = Str::slug(Str::snake($this->basename), '_'); // hello_world
        $modelVariable = Str::of($this->basename)->camel(); // helloWorld
        $modelVariablePlural = Str::plural($modelVariable); // helloWorlds
        $namespace = "App\Services\\$model";
        $rootNamespace = 'App\\';
        $savePath = app_path("Services/{$model}/$class.php");

        return compact([
            'class',
            'service',
            'serviceVariable',
            'format',
            'formatVariable',
            'view',
            'modelVariable',
            'modelVariablePlural',
            'namespace',
            'rootNamespace',
            'savePath',
            'model',
        ]);
    }
}
