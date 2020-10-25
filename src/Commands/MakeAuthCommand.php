<?php

namespace Phambinh217\LaravelPlus\Commands;

use Illuminate\Console\Command;
use Phambinh217\LaravelPlus\ServiceProvider;

class MakeAuthCommand extends Command
{
    protected $signature = 'make:auth';

    protected $description = 'Generate service';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $type = $this->choise('Select your auth type?', ['UI', 'API'], 0);

        if ($type == 'UI') {
            $this->publishAuthUi();
        } else if ($type == 'API') {
            $this->publishAuthApi();
        }
    }

    private function publishAuthUi()
    {
        $this->publish([
            ServiceProvider::ROOT_DIR.'auth/ui' => base_path(),
        ]);
    }

    private function publishAuthApi()
    {
        $this->publish([
            ServiceProvider::ROOT_DIR.'auth/api' => base_path(),
        ]);
    }
}
