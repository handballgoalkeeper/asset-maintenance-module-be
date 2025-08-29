<?php

use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/vendors')->middleware('auth.jwt')
    ->controller(VendorController::class)->group(function () {

        Route::get(uri: '/', action: 'index');

    });
