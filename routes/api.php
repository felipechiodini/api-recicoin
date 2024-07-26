<?php

use App\Http\Controllers\SingUpController;
use Illuminate\Support\Facades\Route;


Route::prefix('app')
    ->group(function () {
        Route::prefix('auth')
            ->group(function () {
                Route::post('login', 'LoginController@login');
            });

        Route::post('sing-up', SingUpController::class);
    });

