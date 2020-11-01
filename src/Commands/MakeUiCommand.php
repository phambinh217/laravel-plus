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
    }

    private function publishFiles()
    {
        File::copyDirectory(ServiceProvider::ROOT_DIR . 'ui', base_path());
    }
}
