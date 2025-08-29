<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse success(array $data): JsonResponse
 * @method static JsonResponse error(array|string $errors, int $code): JsonResponse
 */
final class ApiResponseFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ApiResponseService::class;
    }
}
