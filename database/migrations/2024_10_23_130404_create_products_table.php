<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void {
        Schema::create('products', function(Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('business_id')->nullable()->constrained('businesses')->cascadeOnDelete();
            $table->string('barcode')->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('bill_name');
            $table->integer('estimated_product_duration')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
