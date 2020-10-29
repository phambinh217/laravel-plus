<?php

namespace Phambinh217\LaravelPlus\Commands;

use Illuminate\Console\Command;
use Phambinh217\LaravelPlus\ServiceProvider;
use File;

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
        $this->publishAuthFiles();

        $this->info('Make auth sucessfuly!');
        $this->info('Your routes');
        $this->line("Route::group(['namespace' => 'App\Http\Controllers'], function () {");
        $this->line("   Route::post('auth/register', 'AuthController@register')->name('auth.register');");
        $this->line("   Route::post('auth/login', 'AuthController@login')->name('auth.login');");
        $this->line("   Route::group(['middleware' => 'auth:sanctum'], function () {");
        $this->line("       Route::delete('auth/logout', 'AuthController@logout')->name('auth.logout');");
        $this->line("       Route::get('account', 'AccountController@user')->name('account.user');");
        $this->line("       Route::put('account', 'AccountController@update')->name('account.update');");
        $this->line("       Route::put('account/password', 'AccountController@changePassword')->name('account.change-password');");
        $this->line("   });");
        $this->line("});");
    }

    private function publishAuthFiles()
    {
        File::copyDirectory(ServiceProvider::ROOT_DIR . 'auth', base_path());
    }
}
