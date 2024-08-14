<?php

use Illuminate\Support\Facades\Route;

Route::prefix('collect')
    ->group(function() {
        Route::post('{collect}/accept', App\Admin\Controllers\AcceptCollectController::class);
        Route::post('{collect}/finish', App\Admin\Controllers\FinishCollectController::class);
        Route::post('{collect}/reject', App\Admin\Controllers\RejectCollectController::class);
        Route::get('list', App\Admin\Controllers\ListCollectController::class);
    });

Route::prefix('withdraw')
    ->group(function() {
        Route::post('{withdraw}/pay', App\Admin\Controllers\PayWithdrawController::class);
    });

