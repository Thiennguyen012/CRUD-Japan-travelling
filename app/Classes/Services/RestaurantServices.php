<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IPrefectureRepository;
use App\Classes\Repository\RestaurantRepository;
use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Requests\Admin\StoreRestaurantRequest;

class RestaurantServices implements IRestaurantService
{
    private $restaurantRepo;
    // constructor
    public function __construct(RestaurantRepository $restaurantRepo)
    {
        $this->restaurantRepo = $restaurantRepo;
    }


    public function listAllRestaurant()
    {
        $condititon = [];
        $data = $this->restaurantRepo->find($condititon);
        return $data;
    }
    public function newRestaurant(StoreRestaurantRequest $request)
    {
        $data = $this->restaurantRepo->create($request->all());
        return $data;
    }
    public function restaurantDetail(int $id)
    {
        if (!$id) {
            return null;
        }
        $restaurant = $this->restaurantRepo->findOne(['restaurant_id' => $id]);
        if (!$restaurant) {
            return null;
        }
        return $restaurant;
    }
    public function updateRestaurant(StoreRestaurantRequest $request, int $id)
    {
        $restaurant = $this->restaurantRepo->findOne(['restaurant_id' => $id]);
        if (!$restaurant) return null;
        $restaurant->update($request->all());
        return $restaurant;
    }
    public function deleteRestaurant(int $id)
    {
        $restaurant = $this->restaurantRepo->findOne(['restaurant_id' => $id]);
        if (!$restaurant) return null;
        $restaurant_name = $restaurant->restaurant_name;
        $restaurant->delete();
        return $restaurant_name;
    }
    public function searchRestaurantByName(string $restaurant_name)
    {
        $restaurant = $this->restaurantRepo->findOne(['restaurant_name' => $restaurant_name]);
        if (!$restaurant) return null;
        return $restaurant;
    }
    public function getRestaurantByPrefID($id)
    {
        $restaurant = $this->restaurantRepo->find(['prefecture_id' => $id]);
        return $restaurant;
    }
}
