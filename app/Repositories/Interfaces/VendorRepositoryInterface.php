<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
interface VendorRepositoryInterface
{
    /**
     * @param  array<string, string>  $filters
     * @return array{
     *     items: Collection<int, T>,
     *     totalCount: int
     * }
     */
    public function getPaginated(
        int $page,
        int $perPage,
        string $sortBy,
        string $sortDirection,
        array $filters
    ): array;
}
