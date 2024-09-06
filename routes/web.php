<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PpskController;
use App\Http\Controllers\SignageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'welcome'])
    ->name('welcome');

Route::get('/share/{uuid}', [SignageController::class, 'view'])
    ->name('signage.view');

Route::middleware('auth')->group(function () {

    Route::get('/ppsks', [ProfileController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::get('/ppsk', [PpskController::class, 'new'])
        ->name('ppsk.new');
    Route::post('/ppsk', [PpskController::class, 'store'])
        ->name('ppsk.store');
    Route::get('/ppsk/{id}', [PpskController::class, 'edit'])
        ->name('ppsk.edit');
    Route::patch('/ppsk/{id}', [PpskController::class, 'update'])
        ->name('ppsk.update');
    Route::delete('/ppsk/{id}', [PpskController::class, 'destroy'])
        ->name('ppsk.destroy');

});

require __DIR__ . '/auth.php';
