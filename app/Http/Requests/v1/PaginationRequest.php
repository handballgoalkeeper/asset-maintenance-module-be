<?php

declare(strict_types=1);

namespace App\Http\Requests\v1;

use App\Http\Requests\ApiRequest;
use App\Traits\AfterValidationDataTransformHook;
use Illuminate\Contracts\Validation\ValidationRule;

final class PaginationRequest extends ApiRequest
{
    use AfterValidationDataTransformHook;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'page' => 'required|integer|min:1',
            'per_page' => 'required|integer|min:1|',
            'sort_by' => 'sometimes|string',
            'sort_direction' => [
                'sometimes',
                'string',
                'in:asc,desc',
                function ($attribute, $value, $fail) {
                    if (! $this->has('sort_by')) {
                        $fail($attribute.' cannot be provided without sort_by.');
                    }
                },
            ],
            'filters' => ['sometimes', 'array', function ($attribute, $value, $fail) {
                foreach (array_keys($value) as $key) {
                    if (! is_string($key)) {
                        $fail("All $attribute keys must be strings.");
                    }
                }
            }],
            'filters.*' => 'string',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sort_by' => $this->query('sort_by', 'id'),
            'sort_direction' => $this->query('sort_direction', 'asc'),
            'filters' => $this->query('filters', []),
        ]);
    }

    public function afterValidationDataTransform(array $data): array
    {
        $data['page'] = (int) $data['page'];
        $data['per_page'] = (int) $data['per_page'];

        return $data;
    }
}
