<?php

declare(strict_types=1);

use App\Http\Controllers\v1\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/vendors')->middleware('auth.jwt')
    ->controller(VendorController::class)->group(function () {

        Route::get(uri: '/', action: 'index');

    });
