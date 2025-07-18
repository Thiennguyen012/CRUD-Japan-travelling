<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHotelRequest;
use App\Http\Requests\Admin\StoreRestaurantRequest;
use App\Models\Prefecture;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    protected $prefecture;
    protected $restaurant;

    // tạo constructor
    public function __construct(Restaurant $restaurant, Prefecture $prefecture)
    {
        $this->prefecture = $prefecture;
        $this->restaurant = $restaurant;
    }

    /**
     * Display a listing of the resource.
     */
    // Hiển thị list tất cả các nhà hàng
    public function index()
    {
        $restaurant = $this->restaurant->with('prefecture')->get();
        return response()->json([
            'success' => true,
            'message' => 'List all the Restaurants',
            'count' => $restaurant->count(),
            'data' => $restaurant
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
        $restaurant = $this->restaurant->fill($request->all());
        $restaurant->save();
        return response()->json([
            'success' => true,
            'message' => 'New restaurant has been added!',
            'data' => $restaurant,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!$id) {
            return response()->json([
                'success' => false,
                'error' => 'ID not found!',
            ]);
        }
        $restaurant = $this->restaurant->where('restaurant_id', $id)->first();
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'error' => 'Restaurant not found!',
            ]);
        }
        $restaurant_name = $restaurant->restaurant_name;
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
    public function update(StoreRestaurantRequest $request, string $id)
    {
        $restaurant = $this->restaurant->where('restaurant_id', $id)->first();
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'errro' => 'Restaurant not Found!'
            ]);
        }
        // $validate_request = $request->validated();

        $restaurant->update($request->all());
        // cập nhật lại quan hệ với prefecture
        $restaurant->load('Prefecture');
        return response()->json([
            'success' => true,
            'message' => 'Restaurant Infomation has been updated',
            'data' => $restaurant,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $restaurant = $this->restaurant->where('restaurant_id', $id)->first();
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'error' => 'ID not match any restaurant!',
            ]);
        }
        $restaurant_name = $restaurant->restaurant_name;
        $restaurant->delete();
        return response()->json([
            'success' => true,
            'message' => 'Restaurant ' . $restaurant_name . ' has been deleted successfully!'
        ]);
    }
    public function searchRestaurant($restaurant_name)
    {
        $restaurant = $this->restaurant::getRestaurantListByName($restaurant_name);
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
        $restaurant = $this->restaurant->where('prefecture_id', $id)->get();
        $prefecture = $this->prefecture->where('prefecture_id', $id)->first();
        $prefecture_name = $prefecture->prefecture_name;
        if ($restaurant->isEmpty()) {
            return response()->json([
                'success' => false,
                'error' => 'No restaurant founded in ' . $prefecture_name,
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'List Restaurant in ' . $prefecture_name . ':',
            'data' => $restaurant,
        ]);
    }
}
