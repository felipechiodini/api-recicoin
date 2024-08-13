<?php

use Illuminate\Support\Facades\Route;

Route::prefix('collect')
    ->group(function() {
        Route::post('{collect}/accept', App\Admin\Controllers\AcceptCollectController::class);
        Route::post('{collect}/finish', App\Admin\Controllers\FinishCollectController::class);
    });

Route::prefix('withdraw')
    ->group(function() {
        Route::post('{withdraw}/finish', App\Admin\Controllers\FinishWithdrawController::class);
    });

