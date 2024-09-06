<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PpskSettingsController;

Route::post('/ppsk-settings/{uuid}', [PpskSettingsController::class, 'store'])
    ->name('ppsk.settings.store');

Route::get('/ppsk-settings/{uuid}', [PpskSettingsController::class, 'show'])
    ->name('ppsk.settings.show');
