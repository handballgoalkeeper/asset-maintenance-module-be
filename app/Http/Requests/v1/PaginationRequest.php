<?php

declare(strict_types=1);

namespace App\Http\Requests\v1;

use App\Http\Requests\ApiRequest;
use App\Traits\AfterValidationDataTransformHook;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class PaginationRequest extends ApiRequest
{
    use AfterValidationDataTransformHook;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<int, string|Closure>|string>
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
                function (string $attribute, $value, Closure $fail): void {
                    if (! $this->has('sort_by')) {
                        $fail($attribute.' cannot be provided without sort_by.');
                    }
                },
            ],
            'filters' => ['sometimes', 'array', function (string $attribute, array $value, Closure $fail): void {
                foreach (array_keys($value) as $key) {
                    if (! is_string($key)) {
                        $fail("All $attribute keys must be strings.");
                    }
                }
            }],
            'filters.*' => 'string',
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return non-empty-array<string, mixed>
     */
    protected function afterValidationDataTransform(array $data): array
    {
        /** @var string $pageRaw */
        $pageRaw = $data['page'];
        /** @var string $perPageRaw */
        $perPageRaw = $data['per_page'];

        $data['page'] = $pageRaw;
        $data['per_page'] = $perPageRaw;

        return $data;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sort_by' => $this->query('sort_by', 'id'),
            'sort_direction' => $this->query('sort_direction', 'asc'),
            'filters' => $this->query('filters', []),
        ]);
    }
}
