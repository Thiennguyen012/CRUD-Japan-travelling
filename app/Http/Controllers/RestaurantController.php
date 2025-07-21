<?php

namespace App\Http\Controllers;

use App\Classes\Repository\Interfaces\IPrefectureRepository;
use App\Classes\Repository\Interfaces\IRestaurantRepository;
use App\Models\Prefecture;
use App\Models\Restaurant;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class RestaurantController extends Controller
{

    protected $restaurantRepo, $prefectureRepo;
    //Tạo constructor khởi tạo

    public function __construct(IRestaurantRepository $restaurantRepo, IPrefectureRepository $prefectureRepo)
    {
        $this->restaurantRepo = $restaurantRepo;
        $this->prefectureRepo = $prefectureRepo;
    }

    /**
     * Hiển thị trang chủ restaurant với các vùng
     * 
     * @return View
     */
    public function index(): View
    {
        return view('user.restaurant');
    }

    //controller gọi tới model để lấy ra danh sách các nhà hàng theo vùng
    // string $prefecture_name mà không phải int $prefecture_id vì request sẽ truyền vào tên vùng
    public function listRestaurant(string $prefecture_name): View
    {
        //đầu tiên lấy ra prefecture dựa vào tên vùng được truyền vào, lấy ra bản ghi đầu tiên
        // $prefecture = $this->prefecture->where('prefecture_name_alpha', $prefecture_name)->first();
        // tìm nhà hàng ở vùng đó với prefecture vừa lấy được
        // so sánh prefecture_id của bảng prefecture và prefecture_id của bảng restaurant
        // $restaurant = $this->restaurantRepo->where('prefecture_id', $prefecture->prefecture_id)->get();
        // truyền $restaurants xuống view
        //

        // dùng repository thay vì gọi eloquent querry builder trực tiếp từ class như trước
        $restaurant = $this->restaurantRepo->searchRestaurantByPrefName($prefecture_name);
        return view('user.restaurantlist', compact('restaurant'));
    }

    // Lấy ra data detail của 1 restaurant với id
    public function restaurantDetail(int $restaurant_id): View
    {
        $restaurant_detail = $this->restaurantRepo->findOne(['restaurant_id' => $restaurant_id]);
        return view('user.restaurant.restaurantDetail', compact('restaurant_detail'));
    }
}
