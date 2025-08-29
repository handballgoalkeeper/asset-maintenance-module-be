<?php
declare(strict_types=1);

namespace App\Facades;

use App\Services\ApiResponseService;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;
use JsonSerializable;

/**
 * @method static JsonResponse success(JsonSerializable|Arrayable<string, string>|array<string, string> $data, int $code = 200)
 * @method static JsonResponse error(array<string, string>|string $errors, int $code = 400)
 */
final class ApiResponseFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ApiResponseService::class;
    }
}
