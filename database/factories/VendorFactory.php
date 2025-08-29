<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'website' => $this->faker->url(),
            'contact_person_name' => $this->faker->name(),
            'contact_person_email' => $this->faker->email(),
            'contact_person_phone' => $this->faker->phoneNumber(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
