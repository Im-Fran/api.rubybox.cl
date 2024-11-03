<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void {
        Schema::create('business_associated_products', function(Blueprint $table) {
            $table->id();
            $table->uuidMorphs('business_id');
            $table->uuidMorphs('product_id');
            $table->foreignUuid('category_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('business_associated_products');
    }
};
