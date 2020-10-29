<?php

namespace App\Services\User\Actions;

use Phambinh217\LaravelPlus\Executor\Result;
use Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Arr;

class UpdateUserAction
{
    public function handle(User $user, array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return Result::error($message, new ValidationException($validator));
        }

        $user = $this->update($user, $data);

        return Result::success($user);
    }

    private function update(User $user, array $data)
    {
        return $user->update(Arr::only($data, [
            'name'
        ]));
    }

    private function validate($data)
    {
        $validator = Validator::make($data, [
            'name' => 'nullable|required'
        ], [
            'name.required' => 'Họ và tên không được để trống'
        ]);

        return $validator;
    }
}
