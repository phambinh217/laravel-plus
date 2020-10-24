<?php

namespace Phambinh217\LaravelPlus\Commands\ScaffoldGuides;

use Phambinh217\LaravelPlus\Commands\ScaffoldingCommand;
use Phambinh217\LaravelPlus\Scaffold\ControllerScaffold;
use Str;

class ControllerGuide
{
    private $command;
    private $scaffold;

    public function __construct(ScaffoldingCommand $command, ControllerScaffold $scaffold)
    {
        $this->command = $command;
        $this->scaffold = $scaffold;
    }

    public function writeDown()
    {
        $variables = $this->scaffold->variables();
        $controller = $variables['class'];
        $baseRoutename = Str::plural($variables['view']);
        $baseUri = Str::slug($baseRoutename, '-');

        $this->command->info('> Add routes: ');
        $routes = [
            [
                'method' => 'get',
                'uri' => "$baseUri",
                'action' => "$controller@index",
                'name' => "$baseRoutename.index"
            ],
            [
                'method' => 'post',
                'uri' => "$baseUri",
                'action' => "$controller@store",
                'name' => "$baseRoutename.store"
            ],
            [
                'method' => 'get',
                'uri' => "$baseUri/{id}",
                'action' => "$controller@show",
                'name' => "$baseRoutename.show"
            ],
            [
                'method' => 'put',
                'uri' => "$baseUri/{id}",
                'action' => "$controller@update",
                'name' => "$baseRoutename.update"
            ],
            [
                'method' => 'delete',
                'uri' => "$baseUri/{id}",
                'action' => "$controller@delete",
                'name' => "$baseRoutename.delete"
            ],
        ];

        if ($this->scaffold->getReturnType() == 'view') {
            $routes = array_merge($routes, [
                [
                    'method' => 'get',
                    'uri' => "$baseUri/create",
                    'action' => "$controller@create",
                    'name' => "$baseRoutename.create"
                ],
                [
                    'method' => 'get',
                    'uri' => "$baseUri/{id}/edit",
                    'action' => "$controller@edit",
                    'name' => "$baseRoutename.edit"
                ],
            ]);
        }

        $this->command->line("Route::group(['namespace' => '{$variables['namespace']}'], function () {");
        foreach ($routes as $route) {
            extract($route);
            $this->command->line("    Route::$method('$uri', '$action')->name('$name');");
        }
        $this->command->line("});");
    }
}
