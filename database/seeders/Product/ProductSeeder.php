<?php

namespace Database\Seeders\Product;

use App\Models\Business\Business;
use App\Models\Product\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {

    public function run(): void {
        Product::factory(10)->create()->each(fn($product) => $this->afterCreate($product));
    }

    public function afterCreate(Product $product): void {
        if (rand(1, 10) === 1) {
            $product->business()->associate(Business::inRandomOrder()->first());
        }
    }
}
