<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

/**
 * @template T
 */
interface VendorRepositoryInterface
{
    /**
     * @param array<string, string> $filters
     * @return array{
     *     items: Collection<T>,
     *     totalCount: int
     * }
     */
    function getPaginated(
        int $page,
        int $perPage,
        string $sortBy,
        string $sortDirection,
        array $filters
    ): array;
}
