<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\Api\LocalApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rutas principales del Frontend Web
Route::get('/', function () {
    return view('welcome');
});

Route::resource('locales', LocalController::class);

// =============================================
// RUTAS DE LA API REST (Requeridas por la prueba)
// =============================================

/**
 * API para la prueba técnica
 * GET  /api/locales     → Listado de locales
 * PUT  /api/locales/{id} → Actualizar local
 */
Route::get('/api/locales', [LocalApiController::class, 'index'])
     ->name('api.locales.index');

Route::put('/api/locales/{id}', [LocalApiController::class, 'update'])
     ->name('api.locales.update');