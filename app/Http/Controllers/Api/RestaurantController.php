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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
