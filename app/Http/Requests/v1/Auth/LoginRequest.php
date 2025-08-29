<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\ApiRequest;

final class LoginRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, string> */
    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc',
            'password' => 'required|string',
        ];
    }
}
