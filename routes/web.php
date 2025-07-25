<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\TopController as AdminTopController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

/** user screen */
Route::get('/', [TopController::class, 'index'])->name('top');
Route::get('/{prefecture_name_alpha}/hotellist', [HotelController::class, 'showList'])->name('hotelList');
Route::get('/hotel/{hotel_id}', [HotelController::class, 'showDetail'])->name('hotelDetail');


// route cho restaurant
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurantHome');
Route::get('/{prefecture_name_alpha}/restaurantlist', [RestaurantController::class, 'listRestaurant'])->name('restaurantList');
Route::get('restaurant/{restaurant_id}', [RestaurantController::class, 'restaurantDetail'])->name('restaurantDetail');
Route::get('restaurant/{restaurant_id}/menu', [MenuController::class, 'getMenuByResID'])->name('getMenu');


/** admin screen */
Route::get('/admin', [AdminTopController::class, 'index'])->name('adminTop');
Route::get('/admin/hotel/search', [AdminHotelController::class, 'showSearch'])->name('adminHotelSearchPage');
Route::get('/admin/hotel/edit', [AdminHotelController::class, 'showEdit'])->name('adminHotelEditPage');
Route::get('/admin/hotel/create', [AdminHotelController::class, 'showCreate'])->name('adminHotelCreatePage');
Route::get('/admin/booking/search', [AdminBookingController::class, 'showSearch'])->name('adminBookingSearchPage');
Route::post('/admin/hotel/search', [AdminHotelController::class, 'searchResult'])->name('adminHotelSearchResult');
Route::post('/admin/hotel/edit', [AdminHotelController::class, 'edit'])->name('adminHotelEditProcess');
Route::post('/admin/hotel/create', [AdminHotelController::class, 'create'])->name('adminHotelCreateProcess');
Route::post('/admin/hotel/delete', [AdminHotelController::class, 'delete'])->name('adminHotelDeleteProcess');
Route::post('/admin/booking/search', [AdminBookingController::class, 'searchResult'])->name('adminBookingSearchResult');
