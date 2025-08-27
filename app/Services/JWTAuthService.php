<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\JWTUser;
use Illuminate\Support\Facades\Http;

final readonly class JWTAuthService
{
    private string $baseUrl;

    public function __construct()
    {
        /** @var string $configBaseUrl */
        $configBaseUrl = config('services.jwt_user_auth.url');

        $this->baseUrl = $configBaseUrl;
    }

    public function getUserByToken(string $token): ?JWTUser
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Accept' => 'application/json',
        ])->get("{$this->baseUrl}/auth/whoami");

        /** @var array{
         *     id: int,
         *     name: string,
         *     email: string,
         *     permissions: array<int, array<int, array{ id: int, name: string }>>
         * } $data */
        $data = $response->json();

        if ($response->successful()) {
            return new JWTUser(
                id: $data['id'],
                name: $data['name'],
                email: $data['email'],
                permissions: $data['permissions'],
            );
        }

        return null;
    }

    /**
     * @return array{ status: bool, token: string }
     */
    public function login(string $email, string $password): array
    {
        $response = Http::post("{$this->baseUrl}/auth/login", [
            'email' => $email,
            'password' => $password,
        ]);

        /** @var array{ status: bool, token: string } $data */
        $data = $response->json();

        return $data;
    }
}
