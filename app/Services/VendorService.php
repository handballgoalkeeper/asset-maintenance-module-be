<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Internal\VendorDTO;
use App\DTOs\Responses\PaginatedResponseDTO;
use App\Exceptions\DBOperationException;
use App\Mappers\VendorMapper;
use App\Models\Vendor;
use App\Repositories\Interfaces\VendorRepositoryInterface;
use App\Services\Interfaces\VendorServiceInterface;

/**
 * @implements VendorServiceInterface<VendorDTO>
 */
final readonly class VendorService implements VendorServiceInterface
{
    /**
     * @param  VendorRepositoryInterface<Vendor>  $vendorRepository
     */
    public function __construct(
        private VendorRepositoryInterface $vendorRepository,
        private VendorMapper $vendorMapper
    ) {}

    /**
     * @param  array<string, string>  $filters
     * @return PaginatedResponseDTO<VendorDTO>
     *
     * @throws DBOperationException
     */
    public function getPaginated(
        int $page,
        int $perPage,
        string $sortBy,
        string $sortDirection,
        array $filters
    ): PaginatedResponseDTO {
        $paginatedVendorsData = $this->vendorRepository->getPaginated(
            page: $page,
            perPage: $perPage,
            sortBy: $sortBy,
            sortDirection: $sortDirection,
            filters: $filters,
        );

        $vendors = $paginatedVendorsData['items'];
        $totalCount = $paginatedVendorsData['totalCount'];

        $lastPage = $totalCount > 0 ? (int) ceil($totalCount / $perPage) : 1;

        return new PaginatedResponseDTO(
            items: $this->vendorMapper->modelsToDTOs(vendors: $vendors),
            total: $totalCount,
            perPage: $perPage,
            currentPage: $page,
            lastPage: $lastPage,
            isLastPage: $lastPage === $page,
        );
    }
}
