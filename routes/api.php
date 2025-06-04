<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'countryLang'])->group(function () {
    Route::apiResource('news', \App\Http\Controllers\Api\NewsController::class);
});

