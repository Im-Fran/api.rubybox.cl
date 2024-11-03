<?php

namespace Database\Seeders;

use Database\Seeders\Business\BusinessSeeder;
use Database\Seeders\Product\ProductSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    use WithoutModelEvents;

    public function run(): void {
        $this->call([
            PermissionsSeeder::class,


            UsersSeeder::class,

            BusinessSeeder::class,

            ProductSeeder::class,
        ]);
    }
}
