<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void {
        Schema::create('addresses', function(Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('street_reference');
            $table->string('country');
            $table->string('province');
            $table->string('city');
            $table->string('region')->nullable();
            $table->string('postal_code');
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('addresses');
    }
};
