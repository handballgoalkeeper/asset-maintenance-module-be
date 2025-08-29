<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\DTOs\Responses\PaginatedResponseDTO;

/**
 * @template T
 */
interface VendorServiceInterface
{
    /**
     * @param  array<string, string>  $filters
     * @return PaginatedResponseDTO<T>
     */
    public function getPaginated(
        int $page,
        int $perPage,
        string $sortBy,
        string $sortDirection,
        array $filters,
    ): PaginatedResponseDTO;
}
