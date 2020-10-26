<?php

namespace App\Services\Auth\Actions;

use App\Models\User;

class CreateTokenAction
{
    public function handle(User $user)
    {
        return $user->createToken('person-token');
    }
}
