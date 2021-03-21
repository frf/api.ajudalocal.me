<?php

use App\Api\Controllers\FileController;
use App\Api\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::prefix('locales')->group(function () {
    Route::get('/', [LocaleController::class, 'index'])
        ->name('locale.index');
    Route::post('/', [LocaleController::class, 'create'])
        ->name('locale.create');
});

Route::prefix('locales')->middleware(['auth:api','user_context'])
    ->group(function () {
        Route::patch('/', [LocaleController::class, 'update'])
            ->name('locale.update');
});

