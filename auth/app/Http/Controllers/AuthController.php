<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use App\Formats\UserFormat;

class AuthController extends Controller
{
    public function register(AuthService $authService, Request $request)
    {
        $result = $authService->register($request->all());

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

    public function login(UserFormat $userFormat, AuthService $authService, Request $request)
    {
        $result = $authService->login($request->all());

        if ($result->hasError()) {
            return response()->json([
                'hasError' => true,
                'message' => $result->errorMessage,
                'errors' => $result->detailError->errors(),
            ], 422);
        }

        $user = $result->getValue();
        $token = $authService->createToken($user);

        return response()->json([
            'hasError' => false,
            'token' => $token->plainTextToken,
            'user' => $userFormat->formatAuth($user),
        ]);
    }

    public function logout(AuthService $authService, Request $request)
    {
        $authService->logout($request->user());

        return response()->json([
            'hasError' => false,
        ]);
    }
}
