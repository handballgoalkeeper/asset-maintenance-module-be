<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\JWTProxyController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/auth')->controller(JWTProxyController::class)->group(function () {
    Route::post('/login', 'login');
});
