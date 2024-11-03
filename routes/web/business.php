<?php

use App\Http\Controllers\Business\BusinessController;

Route::prefix('business')->group(function() {
    Route::get('/', [BusinessController::class, 'index'])->name('business.index');
    Route::post('/', [BusinessController::class, 'store'])->middleware(['permission:business.create'])->name('business.store');

    Route::prefix('{business}')->group(function() {
        Route::get('/', [BusinessController::class, 'show'])->middleware(['permission:business.show'])->name('business.show');
        Route::patch('/', [BusinessController::class, 'update'])->middleware(['permission:business.update'])->name('business.update');
        Route::delete('/', [BusinessController::class, 'destroy'])->middleware(['permission:business.destroy'])->name('business.destroy');
    });
});
