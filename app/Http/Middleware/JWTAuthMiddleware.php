<?php

namespace App\Http\Middleware;

use App\DTOs\Requests\JWTUserDTO;
use App\Facades\ApiResponseFacade;
use App\Services\JWTAuthService;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

final readonly class JWTAuthMiddleware
{
    public function __construct(
        private JWTAuthService $JWTAuthService
    ) {}

    /**
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::parseToken();

            /** @var (JWTUserDTO&Authenticatable)|null $user */
            $user = $this->JWTAuthService->getUserByToken((string) $token->getToken());

            if (! $user) {
                return ApiResponseFacade::error(
                    errors: 'You are not authorized to make this request.',
                    code: 401
                );
            }

            Auth::setUser($user);

            return $next($request);
        }
        catch (JWTException) {
            return ApiResponseFacade::error(
                errors: 'You are not authorized to make this request.',
                code: 401
            );
        }
    }
}
