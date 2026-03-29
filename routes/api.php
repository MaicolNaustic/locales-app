<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocalApiController;

Route::prefix('api')->group(function () {
    Route::get('/locales', [LocalApiController::class, 'index'])
         ->name('api.locales.index');

    Route::put('/locales/{id}', [LocalApiController::class, 'update'])
         ->name('api.locales.update');
});