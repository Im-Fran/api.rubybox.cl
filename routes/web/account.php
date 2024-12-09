<?php

use App\Http\Controllers\Account\AccountController;

Route::prefix('account')->middleware(['auth'])->group(function() {
    Route::get('/', [AccountController::class, 'show'])->name('account.show');
});
