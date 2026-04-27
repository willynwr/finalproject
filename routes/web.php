<?php

use App\Http\Controllers\SmartFarmingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rekomendasi-pupuk', [SmartFarmingController::class, 'rekomendasiPupuk']);

Route::get('/api/rekomendasi-data', [SmartFarmingController::class, 'rekomendasiData']);

Route::get('/kesuburan-tanah', [SmartFarmingController::class, 'kesuburanTanah']);

Route::get('/api/kesuburan-data', [SmartFarmingController::class, 'kesuburanData']);
