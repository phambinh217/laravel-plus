<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Formats\UserFormat;

class AccountController extends Controller
{
    public function user(UserFormat $userFormat, Request $request)
    {
        return response()->json([
            'hasError' => false,
            'user' => $userFormat->formatAuth($request->user()),
        ]);
    }

    public function changePassword(UserService $userService, Request $request)
    {
        $result = $userService->changePassword($request->user(), $request->all());

        if ($result->hasError()) {
            return response()->json([
                'hasError' => true,
                'message' => $result->errorMessage,
                'errors' => $result->detailError->errors(),
            ], 422);
        }

        return response()->json([
            'hasError' => false
        ]);
    }

    public function update(UserService $userService, Request $request)
    {
        $result = $userService->update($request->user(), $request->all());

        if ($result->hasError()) {
            return response()->json([
                'hasError' => true,
                'message' => $result->errorMessage,
                'errors' => $result->detailError->errors(),
            ], 422);
        }

        return response()->json([
            'hasError' => false
        ]);
    }
}
