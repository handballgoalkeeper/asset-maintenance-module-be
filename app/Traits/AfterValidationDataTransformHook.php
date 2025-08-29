<?php

declare(strict_types=1);

namespace App\Traits;

trait AfterValidationDataTransformHook
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    abstract protected function afterValidationDataTransform(array $data): array;

    /**
     * @return array<string, mixed>
     */
    public function validatedAndTransformed(): array
    {
        /** @var array<string, mixed> $data */
        $data = $this->validated();

        return $this->afterValidationDataTransform($data);
    }
}
