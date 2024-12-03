<?php

use App\Http\Controllers\Business\BusinessCategoryController;
use App\Http\Controllers\Business\BusinessController;

Route::prefix('business')->group(function() {
    Route::get('/', [BusinessController::class, 'index'])->name('business.index');
    Route::post('/', [BusinessController::class, 'store'])->middleware(['permission:business.create'])->name('business.store');

    Route::prefix('{business}')->group(function() {
        Route::get('/', [BusinessController::class, 'show'])->middleware(['permission:business.show'])->name('business.show');
        Route::patch('/', [BusinessController::class, 'update'])->middleware(['permission:business.update'])->name('business.update');
        Route::delete('/', [BusinessController::class, 'destroy'])->middleware(['permission:business.destroy'])->name('business.destroy');

        Route::prefix('/categories')->group(function() {
            Route::get('/', [BusinessCategoryController::class, 'index'])->middleware(['permission:business.category.view'])->name('business.categories.index');
            Route::post('/', [BusinessCategoryController::class, 'store'])->middleware(['permission:business.category.create'])->name('business.categories.store');

            Route::prefix('{category}')->group(function() {
                Route::get('/', [BusinessCategoryController::class, 'show'])->middleware(['permission:business.category.view'])->name('business.categories.show');
                Route::patch('/', [BusinessCategoryController::class, 'update'])->middleware(['permission:business.category.update'])->name('business.categories.update');
                Route::delete('/', [BusinessCategoryController::class, 'destroy'])->middleware(['permission:business.category.destroy'])->name('business.categories.destroy');
            });
        });
    });
});
