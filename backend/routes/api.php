<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicApiController;

/*
|--------------------------------------------------------------------------
| Public REST API Routes (PT Wanciruso Group Indonesia)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Unit Usaha (8 Pilar)
    Route::get('/unit-usaha', [PublicApiController::class, 'getUnitUsaha']);
    Route::get('/unit-usaha/{slug}', [PublicApiController::class, 'getUnitUsahaBySlug']);

    // Sertifikasi & Legalitas
    Route::get('/sertifikasi', [PublicApiController::class, 'getSertifikasi']);

    // Berita & Media Center
    Route::get('/berita', [PublicApiController::class, 'getBerita']);
    Route::get('/berita/{slug}', [PublicApiController::class, 'getBeritaBySlug']);


    // Form Submissions
    Route::post('/kemitraan', [PublicApiController::class, 'storeKemitraan']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
