<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DTOs\JWTUserDTO;
use App\Facades\ApiResponseFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\JWTAuthService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class JWTProxyController extends Controller
{
    public function login(LoginRequest $request, JWTAuthService $jwtAuthService): JsonResponse
    {
        /** @var array{ email: string, password: string } $requestData */
        $requestData = $request->validated();
        /** @var array{success: bool, token: string} $response */
        $response = $jwtAuthService->login($requestData['email'], $requestData['password']);

        if (! $response['success']) {
            unset($response['success']);

            return ApiResponseFacade::error(data: $response, code: 401);
        }

        unset($response['success']);

        /** @var (JWTUserDTO&Authenticatable)|null $user */
        $user = $jwtAuthService->getUserByToken($response['token']);

        if (! $user) {
            return ApiResponseFacade::error(data: ['error' => 'User does not exist.'], code: 401);
        }

        Auth::setUser($user);

        return ApiResponseFacade::success(data: $response);
    }
}
