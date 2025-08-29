<?php

namespace App\DTOs\Responses;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @template T
 */
final readonly class PaginatedResponseDTO implements \JsonSerializable
{
    /**
     * @param array<int, T> $items
     */
    public function __construct(
        private array $items,
        private int $total,
        private int $perPage,
        private int $currentPage,
        private int $lastPage,
        private bool $isLastPage
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'items' => $this->items,
            'total' => $this->total,
            'per_page' => $this->perPage,
            'current_page' => $this->currentPage,
            'last_page' => $this->lastPage,
            'is_last_page' => $this->isLastPage,
        ];
    }
}
