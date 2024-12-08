<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void {
        Schema::create('businesses', function(Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('name');
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();

            /* Ownership Tables */
            $table->index('user_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('businesses');
    }
};
