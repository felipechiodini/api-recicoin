<?php

use Illuminate\Support\Facades\Route;

Route::post('login', App\User\Controllers\LoginController::class);
Route::post('sing-up', App\User\Controllers\SingUpController::class);

Route::middleware('auth:sanctum')
    ->group(function() {
        Route::get('collect', App\User\Controllers\Collect\CollectListController::class);
        Route::post('collect/request', App\User\Controllers\Collect\RequestCollectController::class);
        Route::get('collect/{collect}/details', App\User\Controllers\Collect\CollectDetailsController::class);


        Route::post('logout', App\User\Controllers\LogoutController::class);
        Route::get('extract', App\User\Controllers\ExtractController::class);
        Route::post('request-whithdraw', App\User\Controllers\RequestWithdrawController::class);
        Route::post('address', App\User\Controllers\CreateAddressController::class);
    });
