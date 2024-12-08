<?php

namespace Database\Seeders\Business;

use App\Models\Business\Address;
use App\Models\Business\Business;
use App\Models\Business\BusinessCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder {
    public function run(): void {
        User::inRandomOrder()->take(5)->each(fn (User $it) => tap(Business::factory()->create([
            'user_id' => $it->id,
        ]), function(Business $business) {
            $business->categories()->createMany(BusinessCategory::factory(count: 5)->make()->toArray());
            $business->address()->create(Address::factory()->make()->toArray());
        }));
    }

    public function afterCreate(Business $business): void {
        BusinessCategory::factory(count: 5, state: [
            'business_id' => $business->id,
        ])->create();

        Address::factory()->create([
            'business_id' => $business->id,
        ]);
    }
}
