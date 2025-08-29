<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1;

use App\DTOs\Internal\VendorDTO;
use App\Facades\ApiResponseFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PaginationRequest;
use App\Services\Interfaces\VendorServiceInterface;
use Illuminate\Http\JsonResponse;

final readonly class VendorController extends Controller
{
    /**
     * @param  VendorServiceInterface<VendorDTO>  $vendorService
     */
    public function __construct(
        private VendorServiceInterface $vendorService
    ) {}

    public function index(PaginationRequest $request): JsonResponse
    {
        /**
         * @var array{
         *     page: int,
         *     per_page: int,
         *     sort_by: string,
         *     sort_direction: string,
         *     filters: array<string, string>
         * } $paginationRequestData
         */
        $paginationRequestData = $request->validatedAndTransformed();

        $paginatedVendors = $this->vendorService->getPaginated(
            page: $paginationRequestData['page'],
            perPage: $paginationRequestData['per_page'],
            sortBy: $paginationRequestData['sort_by'],
            sortDirection: $paginationRequestData['sort_direction'],
            filters: $paginationRequestData['filters'],
        );

        return ApiResponseFacade::success(data: $paginatedVendors);
    }
}
