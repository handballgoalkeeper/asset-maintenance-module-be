<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Vendor;
use App\Repositories\Interfaces\VendorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * @implements VendorRepositoryInterface<Vendor>
 */
final class VendorRepository implements VendorRepositoryInterface
{
    /**
     * @param  array<string, string>  $filters
     * @return array{
     *     items: Collection<int, Vendor>,
     *     totalCount: int
     * }
     */
    public function getPaginated(int $page, int $perPage, string $sortBy, string $sortDirection, array $filters): array
    {
        $offset = ($page - 1) * $perPage;

        $baseQuery = Vendor::query()
            ->orderBy(column: $sortBy, direction: $sortDirection)
            ->select([
                'id', 'name', 'email', 'phone',
                'address', 'website', 'contact_person_name',
                'contact_person_email', 'contact_person_phone', 'is_active',
            ]);

        $totalCount = (clone $baseQuery)->count();

        $vendors = $baseQuery
            ->skip($offset)
            ->take($perPage)
            ->get();

        return [
            'items' => $vendors,
            'totalCount' => $totalCount,
        ];
    }
}
