<?php

namespace App\Services\Auth\Actions;

use Phambinh217\LaravelPlus\Executor\Execute;
use Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Hash;

class ChangePasswordAction
{
    use Execute;

    public function handle(User $user, array $data)
    {
        return $this->execute(function ($success, $error) use ($data, $user) {
            $validator = $this->validate($data);

            if ($validator->fails()) {
                $message = $validator->errors()->first();
                return $error($message, new ValidationException($validator));
            }

            $this->changePassword($user, $data);

            return $success($user);
        });
    }

    private function changePassword(User $user, array $data)
    {
        $user->update([
            'password' => Hash::make($data['password'])
        ]);
    }

    private function validate($data)
    {
        $validator = Validator::make($data, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        return $validator;
    }
}
