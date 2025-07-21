<?php

namespace App\Classes\Repository\Interfaces;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Collection;

interface IRestaurantRepository extends IBaseRepository
{

    public function searchRestaurantByPrefName(String $prefecture_name): Collection;
    public function getRestaurantListByName(string $restaurant_name): array;
}
