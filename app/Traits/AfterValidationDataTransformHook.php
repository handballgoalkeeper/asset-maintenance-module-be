<?php

namespace App\Traits;

trait AfterValidationDataTransformHook
{
    public function validatedAndTransformed(): array
    {
        $data = $this->validated();

        if (method_exists($this, 'afterValidationDataTransform')) {
            $data = $this->afterValidationDataTransform($data);
        }
        return $data;
    }
}
