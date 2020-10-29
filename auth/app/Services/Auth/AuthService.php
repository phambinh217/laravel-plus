<?php

namespace App\Services\Auth;

use App\Services\Auth\Actions;
use App\Models\Auth;
use Phambinh217\LaravelPlus\Service\BaseService;

class AuthService extends BaseService
{
    protected $actions = [
        'login' => Actions\LoginAction::class,
        'register' => Actions\RegisterAction::class,
        'logout' => Actions\LogoutAction::class,
        'createToken' => Actions\CreateTokenAction::class,
    ];
}
