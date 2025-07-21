<?php

namespace App\Classes\Services\Interfaces;

use App\Http\Requests\Admin\StoreRestaurantRequest;

interface IRestaurantService
{
    public function listAllRestaurant();
    public function newRestaurant(StoreRestaurantRequest $request);
    public function restaurantDetail(int $id);
    public function updateRestaurant(StoreRestaurantRequest $request, int $id);
    public function deleteRestaurant(int $id);
    public function searchRestaurantByName(string $restaurant_name);
    public function getRestaurantByPrefID(int $id);
}
