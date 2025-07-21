<?php

namespace App\Classes\Repository;

use Illuminate\Database\Eloquent\Collection;
use App\Classes\Repository\Interfaces\IRestaurantRepository;
use App\Models\Restaurant;
use GuzzleHttp\Psr7\Request;

class RestaurantRepository extends BaseRepository implements IRestaurantRepository
{
    /**
     * Create a new class instance.
     */
    // constructor lớp con gọi lại constructor lớp cha và truyền 1 instance Restaurant vào
    // Lúc này $this->model là 1 instance của Restaurant
    public function __construct(Restaurant $restaurant)
    {
        parent::__construct($restaurant);
    }

    // Các hàm implement từ interface IRestaurant
    public function searchRestaurantByPrefName(String $prefecture_name): Collection
    {
        $prefecture = app(\App\Models\Prefecture::class)->where('prefecture_name_alpha', $prefecture_name)->first();

        if (!$prefecture) {
            return collect(); // Trả về collection rỗng nếu không tìm thấy prefecture
        }

        // dùng find(array $condition) trong base
        $result = $this->model->find(['prefecture_id' => $prefecture->prefecture_id]);
        return $result;
    }
    public function getRestaurantListByName(string $restaurant_name): array
    {
        $condition = ['restaurant_name', 'like', "%{$restaurant_name}%"];
        $result = $this->model->findOne($condition);
        return $result;
    }
}
