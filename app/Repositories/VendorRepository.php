<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\DBOperationsExceptionError;
use App\Exceptions\DBOperationException;
use App\Models\Vendor;
use App\Repositories\Interfaces\VendorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

/**
 * @implements VendorRepositoryInterface<Vendor>
 */
final class VendorRepository implements VendorRepositoryInterface
{
    /**
     * @param array<string, string> $filters
     * @return array{
     *     items: Collection<int, Vendor>,
     *     totalCount: int
     * }
     * @throws DBOperationException
     */
    public function getPaginated(int $page, int $perPage, string $sortBy, string $sortDirection, array $filters): array
    {
        $offset = ($page - 1) * $perPage;
        try {
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
        }
        catch (Throwable) {
            throw new DBOperationException(message: DBOperationsExceptionError::FETCHING_DATA_EXCEPTION->value);
        }

        return [
            'items' => $vendors,
            'totalCount' => $totalCount,
        ];
    }
}
