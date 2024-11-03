<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void {
        Schema::create('product_prices', function(Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignUuid('business_id')->constrained('businesses')->cascadeOnDelete();
            $table->decimal('price');
            $table->string('currency');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_prices');
    }
};
