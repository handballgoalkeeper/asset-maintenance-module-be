<?php

namespace App\Services;

use App\DTOs\Responses\PaginatedResponseDTO;
use App\Mappers\VendorMapper;
use App\Models\Vendor;
use App\Repositories\Interfaces\VendorRepositoryInterface;
use App\Services\Interfaces\VendorServiceInterface;

/**
 * @implements VendorServiceInterface<Vendor>
 */
final readonly class VendorService implements VendorServiceInterface
{
    public function __construct(
        private VendorRepositoryInterface $vendorRepository,
        private VendorMapper $vendorMapper
    ) {}

    /**
     * @param array<string, string> $filters
     * @return PaginatedResponseDTO<Vendor>
     */
    function getPaginated(
        int $page,
        int $perPage,
        string $sortBy,
        string $sortDirection,
        array $filters
    ): PaginatedResponseDTO
    {
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
