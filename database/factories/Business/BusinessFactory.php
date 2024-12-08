<?php

namespace Database\Factories\Business;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BusinessFactory extends Factory {
    protected $model = Business::class;

    public function definition(): array {
        return [
            'name' => $this->faker->company(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
