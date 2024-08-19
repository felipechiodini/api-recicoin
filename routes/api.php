<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app')
    ->group(base_path('app/User/Routers/api.php'));

Route::prefix('admin')
->group(base_path('app/Admin/Routers/api.php'));

Route::fallback(function() {
    return response()->json(['message' => 'Not Found'], 404);
});
