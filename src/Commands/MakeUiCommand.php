<?php

namespace Phambinh217\LaravelPlus\Commands;

use Illuminate\Console\Command;
use Phambinh217\LaravelPlus\ServiceProvider;
use File;

class MakeUiCommand extends Command
{
    protected $signature = 'make:ui';

    protected $description = 'Generate ui';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->publishFiles();

        $this->info('Ui published sucessfuly');

        $this->info('Add routes');
        $this->line("Route::get('api/init', 'App\Http\Controllers\MainController')->name('init');");
        $this->line("Route::get('/', 'App\Http\Controllers\MainController@index')->name('home');");
    }

    private function publishFiles()
    {
        File::copyDirectory(ServiceProvider::ROOT_DIR . 'ui', base_path());
    }
}
