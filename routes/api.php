<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app')
    ->group(function() {
        Route::post('login', App\Http\Controllers\LoginController::class);
        Route::post('sing-up', App\Http\Controllers\SingUpController::class);

        Route::middleware('auth:sanctum')
        ->group(function() {
                Route::post('logout', App\Http\Controllers\LogoutController::class);
                Route::get('extract', App\Http\Controllers\ExtractController::class);
                Route::post('collect/request', App\Http\Controllers\RequestCollectController::class);
                Route::get('collect/{collect}/details', App\Http\Controllers\CollectDetailsController::class);
                Route::post('request-whithdraw', App\Http\Controllers\RequestWhithdrawController::class);
                Route::post('address', App\Http\Controllers\CreateAddressController::class);
            });
    });

