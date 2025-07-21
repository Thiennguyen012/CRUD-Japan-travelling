<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\MenuController;

// các route customize khác ngoài những route có sẵn lấy từ apiResource
// Custom routes (đặt trước apiResource)
Route::prefix('hotels')->group(function () {
    Route::get('prefecture/{prefecture_name}', [HotelController::class, 'getHotelByPrefName']);
});
Route::prefix('restaurants')->group(function () {
    Route::get('name/{restaurant_name}', [RestaurantController::class, 'searchRestaurant']);
    Route::get('prefecture/{prefecture_id}', [RestaurantController::class, 'getRestaurantByPrefID']);
    Route::get('{id}/menu', [MenuController::class, 'show']);
    Route::delete('{id}/menu', [MenuController::class, 'destroy']);
    Route::post('menu', [MenuController::class, 'store']);
});

Route::apiResource('hotels', HotelController::class);
Route::apiResource('restaurants', RestaurantController::class);
