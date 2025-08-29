<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use JsonSerializable;

final readonly class ApiResponseService
{
    /**
     * @template TValue
     *
     * @param  JsonSerializable|Arrayable<int, TValue>|array<int, TValue>  $data
     */
    public function success(JsonSerializable|Arrayable|array $data, int $code = 200): JsonResponse
    {
        if ($code < 200 || $code > 299) {
            throw new InvalidArgumentException('Invalid status code');
        }

        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        } elseif ($data instanceof JsonSerializable) {
            $data = $data->jsonSerialize();
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ], $code);
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
