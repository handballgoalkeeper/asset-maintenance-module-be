<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Facades\ApiResponseFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\JWTAuthService;
use Illuminate\Http\JsonResponse;

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

            return ApiResponseFacade::error(errors: $response, code: 401);
        }

        unset($response['success']);

        return ApiResponseFacade::success(data: $response);
    }
}
