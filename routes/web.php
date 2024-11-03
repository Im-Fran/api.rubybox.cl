<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => ['laravel_version' => app()->version()]);

// List files under directory 'web'
foreach (glob(__DIR__.'/web/*.php') as $filename) {
    require $filename;
}
