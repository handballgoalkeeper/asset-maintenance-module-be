<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use JsonSerializable;

final readonly class ApiResponseService
{
    /**
     * @param JsonSerializable|array<string, string> $data
     */
    public function success(JsonSerializable|array $data, int $code = 200): JsonResponse
    {
        if ($code > 299 || $code < 200) {
            throw new InvalidArgumentException('Invalid status code');
        }

        return response()->json(data: [
            'success' => true,
            'data' => $data,
        ], status: $code);
    }

    /**
     * @param  array<string, string>|string  $errors
     */
    public function error(array|string $errors, int $code): JsonResponse
    {
        if ($code > 599 || $code < 400) {
            throw new InvalidArgumentException('Invalid status code');
        }
        if (is_string($errors)) {
            $errors = [$errors];
        }

        return response()->json(data: [
            'success' => false,
            'errors' => $errors,
        ], status: $code);
    }
}
