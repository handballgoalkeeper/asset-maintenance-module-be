<?php

namespace App\Http\Controllers;

use App\Facades\ApiResponseFacade;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class VendorController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponseFacade::success(
            data: Vendor::all()->toArray()
        );
    }
}
