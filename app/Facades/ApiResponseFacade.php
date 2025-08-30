<?php
declare(strict_types=1);

namespace App\Facades;

use App\Services\ApiResponseService;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;
use JsonSerializable;

final class ApiResponseFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ApiResponseService::class;
    }
}
