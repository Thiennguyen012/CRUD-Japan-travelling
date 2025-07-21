<?php

namespace App\Http\Controllers\Api;

use App\Classes\Services\Interfaces\IPrefectureService;
use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\StoreRestaurantRequest;


class RestaurantController extends Controller
{
    protected $prefectureService;
    protected $restaurantService;

    // tạo constructor
    public function __construct(IRestaurantService $restaurantService, IPrefectureService $prefectureService)
    {
        $this->prefectureService = $prefectureService;
        $this->restaurantService = $restaurantService;
    }

    /**
     * Display a listing of the resource.
     */
    // Hiển thị list tất cả các nhà hàng
    public function index()
    {
        $data = $this->restaurantService->listAllRestaurant();
        return response()->json([
            'success' => true,
            'message' => 'List all the Restaurants',
            'count' => $data->count(),
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {

        $data = $this->restaurantService->newRestaurant($request);
        return response()->json([
            'success' => true,
            'message' => 'New restaurant has been added!',
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurant = $this->restaurantService->restaurantDetail($id);
        $restaurant_name = $restaurant->restaurant_name;
        if (!$restaurant) return response()->json([
            'success' => false,
            'error' => 'Restaurant not found!',
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Detail of Restaurant ' . $restaurant_name,
            'data' => $restaurant,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRestaurantRequest $request, int $id)
    {
        $restaurant = $this->restaurantService->updateRestaurant($request, $id);
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'error' => 'Restaurant not Found!'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Restaurant Infomation has been updated',
            'data' => $restaurant,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $restaurant = $this->restaurantService->deleteRestaurant($id);
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'error' => 'ID not match any restaurant!',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Restaurant ' . $restaurant . ' has been deleted successfully!'
        ]);
    }
    public function searchRestaurant($restaurant_name)
    {
        $restaurant = $this->restaurantService->searchRestaurantByName($restaurant_name);
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'error' => 'Not found any restaurant with the name ' . $restaurant_name,
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Result of searching keyword ' . $restaurant_name . ':',
            'data' => $restaurant,
        ]);
    }
    public function getRestaurantByPrefID($id)
    {
        $restaurant = $this->restaurantService->getRestaurantByPrefID($id);
        $prefecture_name = $this->prefectureService->getPrefNameByID($id);
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'error' => 'No restaurant founded '
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'List Restaurant in ' . $prefecture_name . ':',
            'data' => $restaurant,
        ]);
    }
}
