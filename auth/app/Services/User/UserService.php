<?php

namespace App\Services\User;

use App\Services\User\Actions;
use App\Models\User;
use Phambinh217\LaravelPlus\Service\BaseService;

class UserService extends BaseService
{
    protected $actions = [
        'query' => Actions\QueryUserAction::class,
        'create' => Actions\CreateUserAction::class,
        'update' => Actions\UpdateUserAction::class,
        'delete' => Actions\DeleteUserAction::class,
        'changePassword' => Actions\ChangePasswordAction::class,
    ];

    public function find($id)
    {
        return User::find($id);
    }
}
