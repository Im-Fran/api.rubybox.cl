<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void {
        Schema::create('business_categories', function(Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('parent_id')->nullable();
            $table->string('business_id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('business_categories');
    }
};
