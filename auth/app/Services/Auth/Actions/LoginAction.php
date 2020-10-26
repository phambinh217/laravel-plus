<?php

namespace App\Services\Auth\Actions;

use Phambinh217\LaravelPlus\Executor\Execute;
use Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Hash;

class LoginAction
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

            $user = User::where('email', $data['email'])->first();

            return $success($user);
        });
    }

    private function validate($data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $validator->after(function ($validator) use ($data) {
            if (!empty($data['email']) && !empty($data['password'])) {
                $email = $data['email'];
                $user = User::where('email', $email)->first();

                if (!Hash::check($data['password'], $user->password)) {
                    $validator->errors()->add('email', 'Thông tin đăng nhập không chính xác');
                }
            }
        });

        return $validator;
    }
}
