<?php

namespace Phambinh217\LaravelPlus\Scaffold;

use Phambinh217\LaravelPlus\Stub\Stub;
use Str;

class RepositoryScaffold extends BaseScafflold
{
    private $basename;
    private $useAction = true;

    private function __construct($basename)
    {
        $this->basename = $basename;
    }

    public static function make($inputs)
    {
        return new static($inputs['basename']);
    }

    public function useAction($status)
    {
        $this->useAction = $status;
        return $this;
    }

    public function scaffold()
    {
        $variables = $this->variables();

        $stubFile = $this->useAction ? 'repository.action.stub' : 'repository.empty.stub';

        Stub::make([
            'template' => file_get_contents($this->findStub($stubFile)),
            'data' => $variables,
            'output_path' => $variables['savePath'],
        ])->save();
    }

    public function variables()
    {
        $model = Str::studly($this->basename);
        $class = Str::studly($this->basename) . 'Repository'; // HelloWorldRepository
        $repository = Str::studly($this->basename) . 'Repository'; // HelloWorldRepository
        $repositoryVariable = Str::of($this->basename)->camel() . 'Repo'; // helloWorldRepo
        $format = Str::studly($this->basename) . 'Format'; // HelloWorldFormat
        $formatVariable = Str::of($this->basename)->camel() . 'Format'; // helloWorldFormat
        $view = Str::slug(Str::snake($this->basename), '_'); // hello_world
        $modelVariable = Str::of($this->basename)->camel(); // helloWorld
        $modelVariablePlural = Str::plural($modelVariable); // helloWorlds
        $namespace = "App\Repositories\\$model";
        $rootNamespace = 'App\\';
        $savePath = app_path("Repositories/{$model}/$class.php");

        return compact([
            'class',
            'repository',
            'repositoryVariable',
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
