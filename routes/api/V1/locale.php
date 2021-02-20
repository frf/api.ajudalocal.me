<?php

use App\Api\Controllers\FileController;
use App\Api\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::prefix('locales')->middleware(['auth:api','user_context'])
    ->group(function () {

        Route::post('/', [LocaleController::class, 'index'])
            ->name('locale.index');
    });
