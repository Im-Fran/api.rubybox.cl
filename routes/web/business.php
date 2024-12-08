<?php

use App\Http\Controllers\Business\BusinessCategoryController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Product\BusinessAssociatedProductCategoryController;
use App\Http\Controllers\Product\BusinessAssociatedProductController;

Route::prefix('business')->middleware(['auth'])->group(function() {
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

        Route::prefix('associated-products')->group(function(){
            Route::get('/', [BusinessAssociatedProductController::class, 'index'])->middleware(['permission:business.associated-products.view'])->name('business.associated-products.index');
            Route::post('/', [BusinessAssociatedProductController::class, 'store'])->middleware(['permission:business.associated-products.create'])->name('business.associated-products.store');

            Route::prefix('{associatedProduct}')->group(function(){
                Route::get('/', [BusinessAssociatedProductController::class, 'show'])->middleware(['permission:business.associated-products.view'])->name('business.associated-products.show');
                Route::patch('/', [BusinessAssociatedProductController::class, 'update'])->middleware(['permission:business.associated-products.update'])->name('business.associated-products.update');
                Route::delete('/', [BusinessAssociatedProductController::class, 'destroy'])->middleware(['permission:business.associated-products.destroy'])->name('business.associated-products.destroy');

                Route::prefix('categories')->group(function(){
                    Route::get('/', [BusinessAssociatedProductCategoryController::class, 'index'])->middleware(['permission:business.associated-products.categories.view'])->name('business.associated-products.categories.index');
                    Route::post('/', [BusinessAssociatedProductCategoryController::class, 'store'])->middleware(['permission:business.associated-products.categories.create'])->name('business.associated-products.categories.store');
                    Route::delete('/{category}', [BusinessAssociatedProductCategoryController::class, 'destroy'])->middleware(['permission:business.associated-products.categories.destroy'])->name('business.associated-products.categories.destroy');
                });
            });
        });
    });
});
