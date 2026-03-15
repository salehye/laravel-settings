<?php

use Illuminate\Support\Facades\Route;

// Add web routes if needed, e.g., for a settings dashboard
Route::prefix('web-settings')->middleware(config('web-settings.web_middleware'))->group(function () {
    // Route::get('/', [SettingsController::class, 'index'])->name('web-settings.index');
});
