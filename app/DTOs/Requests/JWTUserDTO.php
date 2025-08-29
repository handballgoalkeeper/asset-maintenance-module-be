<?php

declare(strict_types=1);

namespace App\DTOs\Requests;

use Illuminate\Contracts\Auth\Authenticatable;
use JsonSerializable;
use PHPStan\BetterReflection\Reflection\Adapter\Exception\NotImplemented;

final readonly class JWTUserDTO implements Authenticatable, JsonSerializable
{
    /**
     * @param  array<int, array<int, array{ id: int, name:string }>>  $permissions
     */
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private array $permissions
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array<int, array<int, array{ id: int, name:string }>>
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return array{
     *     id: int,
     *     name: string,
     *     email: string,
     *     permissions: array<int, array<int, array{ id: int, name: string }>>
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'permissions' => $this->permissions,
        ];
    }

    public function getAuthIdentifierName(): string
    {
        return $this->name;
    }

    public function getAuthIdentifier(): int
    {
        return $this->id;
    }

    public function getAuthPasswordName(): string
    {
        throw new NotImplemented();
    }

    public function getAuthPassword(): string
    {
        throw new NotImplemented();
    }

    public function getRememberToken(): string
    {
        throw new NotImplemented();
    }

    public function setRememberToken($value): string
    {
        throw new NotImplemented();
    }

    public function getRememberTokenName(): string
    {
        throw new NotImplemented();
    }
}
