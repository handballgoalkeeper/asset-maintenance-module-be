<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\Auth;

use App\DTOs\Requests\JWTUserDTO;
use App\Facades\ApiResponseFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Services\JWTAuthService;
use Illuminate\Http\JsonResponse;

final readonly class JWTProxyController extends Controller
{
    public function login(LoginRequest $request, JWTAuthService $jwtAuthService): JsonResponse
    {
        /** @var array{ email: string, password: string } $requestData */
        $requestData = $request->validated();
        /** @var array<string, string> $response */
        $response = $jwtAuthService->login($requestData['email'], $requestData['password']);

        if (! $response['success']) {
            unset($response['success']);

            return ApiResponseFacade::error(errors: $response, code: 401);
        }

        unset($response['success']);

        $token = $response['token'];

        $user = $jwtAuthService->getUserByToken(token: $token);

        if (! $user instanceof JWTUserDTO) {
            return ApiResponseFacade::error(errors: 'Something went wrong while fetching user data.', code: 500);
        }

        return ApiResponseFacade::success(data: [...$user->jsonSerialize(), 'token' => $token]);
    }
}
