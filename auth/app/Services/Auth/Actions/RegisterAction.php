<?php

namespace App\Services\Auth\Actions;

use Phambinh217\LaravelPlus\Executor\Execute;
use Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Arr;
use Hash;

class RegisterAction
{
    use Execute;

    public function handle(array $data)
    {
        return $this->execute(function ($success, $error) use ($data) {
            $validator = $this->validate($data);

            if ($validator->fails()) {
                $message = $validator->errors()->first();
                return $error($message, new ValidationException($validator));
            }

            $user = $this->create($data);

            return $success($user);
        });
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
            'password' => 'required'
        ]);

        return $validator;
    }
}
