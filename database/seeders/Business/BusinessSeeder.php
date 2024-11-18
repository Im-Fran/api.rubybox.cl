<?php

namespace Database\Seeders\Business;

use App\Models\Business\Business;
use App\Models\Business\BusinessCategory;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder {
    public function run(): void {
        Business::factory(5)->create()->each(fn (Business $it) => $this->afterCreate($it));
    }

    public function afterCreate(Business $business): void {
        BusinessCategory::factory(count: 5, state: [
            'business_id' => $business->id,
        ])->create();
    }
}
