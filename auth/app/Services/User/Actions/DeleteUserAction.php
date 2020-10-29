<?php

namespace App\Services\User\Actions;

use Phambinh217\LaravelPlus\Executor\Result;
use App\Models\User;

class DeleteUserAction
{
    public function handle(User $user)
    {
        $user->delete($data);
        return Result::success(true);
    }
}
