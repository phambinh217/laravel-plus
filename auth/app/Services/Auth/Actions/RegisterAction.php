<?php

namespace App\Services\Auth\Actions;

use Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Phambinh217\LaravelPlus\Executor\Result;
use Arr;
use Hash;

class RegisterAction
{
    public function handle(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return Result::error($message, new ValidationException($validator));
        }

        $user = $this->create($data);

        return Result::success($user);
    }

    private function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return User::create(Arr::only($data, [
            'name',
            'email',
            'password'
        ]));
    }

    private function validate($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6'
        ]);

        return $validator;
    }
}
