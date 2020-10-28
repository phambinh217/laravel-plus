<?php

namespace App\Formats;

use App\Models\User;

class UserFormat
{
    public function formatPaginate($pagination)
    {
        $users = $pagination->items();

        foreach ($users as &$user) {
            $user = $this->formatItem($user);
        }

        return array_merge($pagination->toArray(), [
            'data' => $users,
        ]);

        return $users;
    }

    public function formatList($users)
    {
        $formated = [];
        foreach ($users as $user) {
            $formated[] = $this->formatItem($user);
        }

        return $formated;
    }

    public function formatItem(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    public function formatAuth(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}
