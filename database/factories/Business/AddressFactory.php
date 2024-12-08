<?php

namespace Database\Factories\Business;

use App\Models\Business\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory {
    protected $model = Address::class;

    public function definition(): array {
        return [
            'address_line_1' => $this->faker->streetName(),
            'street_reference' => $this->faker->numerify('####'),
            'country' => $this->faker->country(),
            'province' => $this->faker->city(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
