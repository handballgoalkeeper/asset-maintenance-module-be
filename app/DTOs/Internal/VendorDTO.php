<?php

namespace App\DTOs\Internal;

use JsonSerializable;

final readonly class VendorDTO implements JsonSerializable
{
    public function __construct(
        private int $id,
        private string $name,
        private ?string $email,
        private ?string $phone,
        private ?string $address,
        private ?string $website,
        private ?string $contactPersonName,
        private ?string $contactPersonEmail,
        private ?string $contactPersonPhone,
        private bool $isActive
    ) {}

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'website' => $this->website,
            'contact_person_name' => $this->contactPersonName,
            'contact_person_email' => $this->contactPersonEmail,
            'contact_person_phone' => $this->contactPersonPhone,
            'is_active' => $this->isActive
        ];
    }
}
