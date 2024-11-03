<?php

namespace Database\Factories\Product;

use App\Models\Business\Business;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory {
    protected $model = Product::class;

    public function definition(): array {
        return [
            'business_id' => $this->faker->boolean(chanceOfGettingTrue: 10) ? Business::inRandomOrder()->first()->id : null,
            'barcode' => $this->faker->word(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'bill_name' => $this->faker->name(),
            'estimated_product_duration' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
