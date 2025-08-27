<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Http\JsonResponse;

final class ApiResponseFacade
{
    /**
     * @param  array<string, string>  $data
     */
    public static function success(array $data): JsonResponse
    {
        return response()->json(data: [
            'success' => true,
            ...$data,
        ]);
    }

    /**
     * @param  array<string, string>  $data
     */
    public static function error(array $data, int $code): JsonResponse
    {
        return response()->json(data: [
            'success' => false,
            ...$data,
        ], status: $code);
    }
}
