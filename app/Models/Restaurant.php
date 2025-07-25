<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Arr;

class Restaurant extends Model
{
    // tạo biến lưu id
    protected $primaryKey = 'restaurant_id';

    //Không cho ghi dữ liệu vào cột id
    protected $guarded = ['restaurant_id'];

    // tạo mối quan hệ với bảng Prefecture
    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }

    // tạo mối quan hệ với bảng menu
    public function Menu(): HasOne
    {
        return $this->hasOne(Menu::class);
    }

    // lấy ra thông tin nhà hàng theo tên like ...
    public static function getRestaurantListByName(string $restaurantName): array
    {

        $result = Restaurant::where('restaurant_name', 'like', "%{$restaurantName}%")->get()->toArray();
        return $result;
    }
    // lấy ra tất cả nhà hàng thuộc 1 prefecture
    public static function getRestaurantFromPrefecture(int $prefecture_id): array
    {
        $result = Restaurant::where('prefecture_id', $prefecture_id)->get()->toArray();
        return $result;
    }
}
