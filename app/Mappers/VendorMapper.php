<?php

namespace App\Mappers;

use App\DTOs\Internal\VendorDTO;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;

final readonly class VendorMapper
{
    public function modelToDTO(Vendor $vendor): VendorDTO {
        return new VendorDTO(
            id: $vendor->id,
            name: $vendor->name,
            email: $vendor->email,
            phone: $vendor->phone,
            address: $vendor->address,
            website: $vendor->website,
            contactPersonName: $vendor->contact_person_name,
            contactPersonEmail: $vendor->contact_person_email,
            contactPersonPhone: $vendor->contact_person_phone,
            isActive: $vendor->is_active
        );
    }

    /**
     * @param Collection<Vendor> $vendors
     * @return array<int, VendorDTO>
     */
    public function modelsToDTOs(Collection $vendors): array
    {
        $output = [];
        foreach ($vendors as $vendor) {
            $output[] = $this->modelToDTO(vendor: $vendor);
        }
        return $output;
    }
}
