<?php

namespace App\Services\Auth\Actions;

use Phambinh217\LaravelPlus\Executor\Execute;
use App\Models\User;

class LogoutAction
{
    use Execute;

    public function handle(Auth $user)
    {
        return $user->tokens()->delete();
    }
}
