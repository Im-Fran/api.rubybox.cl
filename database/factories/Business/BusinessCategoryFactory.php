<?php

namespace Database\Factories\Business;

use App\Models\Business\BusinessCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BusinessCategoryFactory extends Factory {
    protected $model = BusinessCategory::class;

    public function definition(): array {
        return [
            'name' => $this->faker->words(2, asText: true),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
