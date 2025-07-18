<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RestaurantController;

// các route customize khác ngoài những route có sẵn lấy từ apiResource
// Custom routes (đặt trước apiResource)
Route::prefix('hotels')->group(function () {
    Route::get('prefecture/{prefecture_name}', [HotelController::class, 'getHotelByPrefId']);
});


Route::apiResource('hotels', HotelController::class);
Route::apiResource('restaurants', RestaurantController::class);
