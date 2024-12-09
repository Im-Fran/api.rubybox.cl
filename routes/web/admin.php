<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->middleware(['auth:sanctum', 'permission:admin.dashboard'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->middleware(['permission:admin.dashboard'])->name('admin.dashboard.index');

    Route::prefix('users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->middleware(['permission:admin.users.view'])->name('admin.users.index');
        Route::post('/', [UserController::class, 'store'])->middleware(['permission:admin.users.create'])->name('admin.users.store');

        Route::prefix('{user}')->group(function() {
            Route::get('/', [UserController::class, 'show'])->middleware(['permission:admin.users.view'])->name('admin.users.show');
            Route::patch('/', [UserController::class, 'update'])->middleware(['permission:admin.users.update'])->name('admin.users.update');
            Route::delete('/', [UserController::class, 'destroy'])->middleware(['permission:admin.users.destroy'])->name('admin.users.destroy');
        });
    });

    Route::prefix('roles')->group(function() {
        Route::get('/', [RoleController::class, 'index'])->middleware(['permission:admin.roles.view'])->name('admin.roles.index');
        Route::post('/', [RoleController::class, 'store'])->middleware(['permission:admin.roles.create'])->name('admin.roles.store');

        Route::prefix('{role}')->group(function() {
            Route::get('/', [RoleController::class, 'show'])->middleware(['permission:admin.roles.view'])->name('admin.roles.show');
            Route::patch('/', [RoleController::class, 'update'])->middleware(['permission:admin.roles.update'])->name('admin.roles.update');
            Route::delete('/', [RoleController::class, 'destroy'])->middleware(['permission:admin.roles.destroy'])->name('admin.roles.destroy');
        });
    });

    Route::prefix('permissions')->group(function() {
        Route::get('/', [PermissionController::class, 'index'])->middleware(['permission:admin.permissions.view'])->name('admin.permissions.index');
        Route::post('/', [PermissionController::class, 'store'])->middleware(['permission:admin.permissions.create'])->name('admin.permissions.store');

        Route::prefix('{permission}')->group(function() {
            Route::get('/', [PermissionController::class, 'show'])->middleware(['permission:admin.permissions.view'])->name('admin.permissions.show');
            Route::patch('/', [PermissionController::class, 'update'])->middleware(['permission:admin.permissions.update'])->name('admin.permissions.update');
            Route::delete('/', [PermissionController::class, 'destroy'])->middleware(['permission:admin.permissions.destroy'])->name('admin.permissions.destroy');
        });
    });

    Route::prefix('products')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->middleware(['permission:admin.products.view'])->name('admin.products.index');
        Route::post('/', [ProductController::class, 'store'])->middleware(['permission:admin.products.create'])->name('admin.products.store');

        Route::prefix('{product}')->group(function() {
            Route::get('/', [ProductController::class, 'show'])->middleware(['permission:admin.products.view'])->name('admin.products.show');
            Route::patch('/', [ProductController::class, 'update'])->middleware(['permission:admin.products.update'])->name('admin.products.update');
            Route::delete('/', [ProductController::class, 'destroy'])->middleware(['permission:admin.products.destroy'])->name('admin.products.destroy');
        });
    });

    Route::prefix('businesses')->group(function() {
        Route::get('/', [BusinessController::class, 'index'])->middleware(['permission:admin.businesses.view'])->name('admin.businesses.index');
        Route::post('/', [BusinessController::class, 'store'])->middleware(['permission:admin.businesses.create'])->name('admin.businesses.store');

        Route::prefix('{business}')->group(function() {
            Route::get('/', [BusinessController::class, 'show'])->middleware(['permission:admin.businesses.view'])->name('admin.businesses.show');
            Route::patch('/', [BusinessController::class, 'update'])->middleware(['permission:admin.businesses.update'])->name('admin.businesses.update');
            Route::delete('/', [BusinessController::class, 'destroy'])->middleware(['permission:admin.businesses.destroy'])->name('admin.businesses.destroy');

            Route::prefix('categories')->group(function() {
                Route::get('/', [BusinessController::class, 'indexCategories'])->middleware(['permission:admin.businesses.categories.view'])->name('admin.businesses.categories.index');
                Route::post('/', [BusinessController::class, 'storeCategory'])->middleware(['permission:admin.businesses.categories.create'])->name('admin.businesses.categories.store');

                Route::prefix('{category}')->group(function() {
                    Route::get('/', [BusinessController::class, 'showCategory'])->middleware(['permission:admin.businesses.categories.view'])->name('admin.businesses.categories.show');
                    Route::patch('/', [BusinessController::class, 'updateCategory'])->middleware(['permission:admin.businesses.categories.update'])->name('admin.businesses.categories.update');
                    Route::delete('/', [BusinessController::class, 'destroyCategory'])->middleware(['permission:admin.businesses.categories.destroy'])->name('admin.businesses.categories.destroy');
                });
            });

            Route::prefix('associated-products')->group(function() {
                Route::get('/', [BusinessController::class, 'indexAssociatedProducts'])->middleware(['permission:admin.businesses.associated-products.view'])->name('admin.businesses.associated-products.index');
                Route::post('/', [BusinessController::class, 'storeAssociatedProduct'])->middleware(['permission:admin.businesses.associated-products.create'])->name('admin.businesses.associated-products.store');

                Route::prefix('{associatedProduct}')->group(function() {
                    Route::get('/', [BusinessController::class, 'showAssociatedProduct'])->middleware(['permission:admin.businesses.associated-products.view'])->name('admin.businesses.associated-products.show');
                    Route::patch('/', [BusinessController::class, 'updateAssociatedProduct'])->middleware(['permission:admin.businesses.associated-products.update'])->name('admin.businesses.associated-products.update');
                    Route::delete('/', [BusinessController::class, 'destroyAssociatedProduct'])->middleware(['permission:admin.businesses.associated-products.destroy'])->name('admin.businesses.associated-products.destroy');

                    Route::prefix('categories')->group(function() {
                        Route::get('/', [BusinessController::class, 'indexAssociatedProductCategories'])->middleware(['permission:admin.businesses.associated-products.categories.view'])->name('admin.businesses.associated-products.categories.index');
                        Route::post('/', [BusinessController::class, 'storeAssociatedProductCategory'])->middleware(['permission:admin.businesses.associated-products.categories.create'])->name('admin.businesses.associated-products.categories.store');
                        Route::delete('/{category}', [BusinessController::class, 'destroyAssociatedProductCategory'])->middleware(['permission:admin.businesses.associated-products.categories.destroy'])->name('admin.businesses.associated-products.categories.destroy');
                    });
                });
            });
        });
    });
});
