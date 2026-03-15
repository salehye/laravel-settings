<?php

use Illuminate\Support\Facades\Route;
use YourVendor\WebSettings\Infrastructure\Http\Controllers\Api\SettingsApiController;

Route::prefix('api/web-settings')->middleware(config('web-settings.api_middleware'))->group(function () {
    Route::get('/', [SettingsApiController::class, 'index'])->name('api.web-settings.index');
    Route::get('/{key}', [SettingsApiController::class, 'show'])->name('api.web-settings.show');
    Route::put('/{key}', [SettingsApiController::class, 'update'])->name('api.web-settings.update');
    Route::delete('/{key}', [SettingsApiController::class, 'destroy'])->name('api.web-settings.destroy');
});
