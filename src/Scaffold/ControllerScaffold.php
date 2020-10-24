<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\Stub\Stub;
use Str;

class ControllerScaffold extends BaseScafflold
{
    private $basename;
    private $useFormat = true;
    private $returnType = 'json';

    private function __construct($basename)
    {
        $this->basename = $basename;
    }

    public function getBasename()
    {
        return $this->basename;
    }

    public function getReturnType()
    {
        return $this->returnType;
    }

    public static function make($inputs)
    {
        return new static($inputs['basename']);
    }

    public function setReturnType($type)
    {
        $this->returnType = $type;
        return $this;
    }

    public function useFormat($status)
    {
        $this->useFormat = $status;
        return $this;
    }

    public function scaffold()
    {
        $variables = $this->variables();

        if ($this->returnType == 'view') {
            $stubFile = 'controller.view.stub';
        } else if ($this->useFormat) {
            $stubFile = 'controller.format.json.stub';
        } else {
            $stubFile = 'controller.json.stub';
        }

        Stub::make([
            'template' => file_get_contents($this->findStub($stubFile)),
            'data' => $variables,
            'output_path' => $variables['savePath'],
        ])->save();
    }

    public function variables()
    {
        $model = Str::studly($this->basename);
        $class = Str::studly($this->basename) . 'Controller'; // HelloWorldController
        $service = Str::studly($this->basename) . 'Service'; // HelloWorldService
        $serviceVariable = Str::of($this->basename)->camel() . 'Repo'; // helloWorldRepo
        $format = Str::studly($this->basename) . 'Format'; // HelloWorldFormat
        $formatVariable = Str::of($this->basename)->camel() . 'Format'; // helloWorldFormat
        $view = Str::slug(Str::snake($this->basename), '_'); // hello_world
        $modelVariable = Str::of($this->basename)->camel(); // helloWorld
        $modelVariablePlural = Str::plural($modelVariable); // helloWorlds
        $namespace = "App\Http\Controller";
        $rootNamespace = 'App\\';
        $savePath = app_path("Http/Controllers/$class.php");

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
