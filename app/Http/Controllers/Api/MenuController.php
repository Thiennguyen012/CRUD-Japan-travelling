<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuRequest;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $restaurant;
    protected $menu;

    public function __construct(Restaurant $restaurant, Menu $menu)
    {
        $this->restaurant = $restaurant;
        $this->menu = $menu;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreMenuRequest $request)
    {
        $dish_name = $request->dish_name;
        // Kiểm tra trùng lặp
        $exist = $this->menu->where('dish_name', $request->dish_name)->first();
        if ($exist) {
            return response()->json([
                'success' => false,
                'error' => 'The dish name ' . $dish_name . ' has already existed!',
            ]);
        }
        $menu = $this->menu->fill($request->all());
        $menu->save();
        $restaurant = $this->restaurant->where('restaurant_id', $menu->restaurant_id)->first();
        $restaurant_name = $restaurant->restaurant_name;
        return response()->json([
            'success' => true,
            'message' => 'Menu of restaurant ' . $restaurant_name . ' has been updated successfully!',
            'data' => $menu,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = $this->menu->where('restaurant_id', $id)->get();
        if ($menu->isEmpty()) {
            return response()->json([
                'success' => false,
                'error' => 'No restaurant with id ' . $id,
            ]);
        }
        $restaurant = $this->restaurant->where('restaurant_id', $id)->first();
        $restaurant_name = $restaurant->restaurant_name;
        return response()->json([
            'success' => true,
            'message' => 'Menu of the restaurant ' . $restaurant_name,
            'data' => $menu,
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
        // Tìm menu item theo ID
        $menu = $this->menu->find($id);

        if (!$menu) {
            return response()->json([
                'success' => false,
                'error' => 'Menu item with ID ' . $id . ' not found!',
            ], 404);
        }

        // Lấy thông tin restaurant trước khi xóa
        $restaurant = $this->restaurant->where('restaurant_id', $menu->restaurant_id)->first();
        $restaurant_name = $restaurant ? $restaurant->restaurant_name : 'Unknown';
        $dish_name = $menu->dish_name;

        // Xóa menu item
        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu item "' . $dish_name . '" from restaurant "' . $restaurant_name . '" has been deleted successfully!',
        ], 200);
    }

    /**
     * Delete all menu items of a specific restaurant
     */
    public function destroyByRestaurant(string $restaurant_id)
    {
        $restaurant = $this->restaurant->where('restaurant_id', $restaurant_id)->first();

        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'error' => 'Restaurant with ID ' . $restaurant_id . ' not found!',
            ], 404);
        }

        $menu_count = $this->menu->where('restaurant_id', $restaurant_id)->count();

        if ($menu_count === 0) {
            return response()->json([
                'success' => false,
                'error' => 'No menu items found for restaurant "' . $restaurant->restaurant_name . '"',
            ], 404);
        }

        // Bulk delete - hiệu quả hơn
        $this->menu->where('restaurant_id', $restaurant_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'All ' . $menu_count . ' menu items of restaurant "' . $restaurant->restaurant_name . '" have been deleted successfully!',
        ], 200);
    }
}
